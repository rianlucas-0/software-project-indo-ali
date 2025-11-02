<?php

namespace App\Http\Controllers;

use App\Models\Local;
use App\Services\UserService;
use App\Services\RecommendationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $userService;
    protected $recommendationService;

    public function __construct()
    {
        $this->userService = UserService::getInstance();
        $this->recommendationService = RecommendationService::getInstance();
    }

    /**
     * Exibe dados na página inicial
     */
    public function showDataInHome(): View
    {
        // Locais mais populares (por favoritos)
        $mostPopular = Local::active()
            ->withCount('favorites')
            ->orderBy('favorites_count', 'desc')
            ->take(6)
            ->get();

        // Bem avaliados (por rating médio)
        $bestRated = Local::active()
            ->withAvg('comments', 'rating')
            ->having('comments_avg_rating', '>', 0)
            ->orderBy('comments_avg_rating', 'desc')
            ->take(6)
            ->get();

        // Adicionados recentemente
        $recentlyAdded = Local::active()
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Recomendações personalizadas (se usuário logado)
        $recommendations = collect();
        if (Auth::check()) {
            $recommendations = $this->recommendationService->getRecommendationsForUser(Auth::id(), 6);
        }

        // Recomendações por categoria (top 3 categorias com mais locais)
        $categories = Local::active()
            ->selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->orderBy('count', 'desc')
            ->take(3)
            ->pluck('category');

        $categoryRecommendations = collect();
        foreach ($categories as $category) {
            $categoryRecommendations->put($category,
                Local::active()
                    ->where('category', $category)
                    ->withCount('favorites')
                    ->orderBy('favorites_count', 'desc')
                    ->take(4)
                    ->get()
            );
        }

        return view('home', compact(
            'mostPopular',
            'bestRated',
            'recentlyAdded',
            'recommendations',
            'categoryRecommendations'
        ));
    }

    public function index(Request $request): View|RedirectResponse
    {
        if ($request->user()->user_type === 'admin') {
            return view('admin.dashboard');
        }

        return redirect()->route('home');
    }

    public function home(Request $request): View|RedirectResponse
    {
        if ($request->user()->user_type === 'admin') {
            return view('admin.dashboard');
        }

        return redirect()->route('home');
    }

    /**
     * Exibe detalhes completos de um local e registra no histórico de visualização
     */
    public function showFullLocal($id): View
    {
        $local = Local::findOrFail($id);

        if (Auth::check()) {
            $this->userService->registerLocalView(Auth::id(), $id);
        }

        $similares = Local::where('id', '!=', $local->id)
            ->where('category', $local->category)
            ->where('city', $local->city)
            ->orderByRaw('(
                (SELECT COUNT(*) FROM favorites WHERE location_id = locations.id) +
                (SELECT COUNT(*) FROM view_history WHERE location_id = locations.id)
            ) DESC')
            ->take(6)
            ->get();

        return view('localfull', compact('local', 'similares'));
    }

    /**
     * Exibe o histórico de visualização do usuário com filtro de tempo opcional
     */
    public function showHistory(Request $request): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $filter = $request->input('filter', 'all');
        $history = $this->userService->getUserViewHistory(Auth::id(), $filter);

        return view('history', compact('history', 'filter'));
    }

    /**
     * Limpa todo o histórico de visualização do usuário
     */
    public function clearHistory(): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->userService->clearUserHistory(Auth::id());

        return redirect()->route('history')->with('success', 'Histórico limpo com sucesso!');
    }

    /**
     * Remove um item específico do histórico de visualização
     */
    public function removeHistoryItem($id): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $result = $this->userService->removeHistoryItem(Auth::id(), $id);

        if ($result) {
            return redirect()->route('history')->with('success', 'Item removido do histórico!');
        }

        return redirect()->route('history')->with('error', 'Item não encontrado!');
    }

    /**
     * Define o relacionamento muitos-para-muitos entre usuário e locais favoritados.
     */
    public function favoriteLocations()
    {
        return $this->belongsToMany(Local::class, 'favorites', 'user_id', 'location_id');
    }
}