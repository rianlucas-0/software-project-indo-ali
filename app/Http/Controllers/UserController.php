<?php

namespace App\Http\Controllers;

use App\Models\Local;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $userService;

        public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Exibe dados na página inicial
     */
    public function showDataInHome(): View
    {
        $local = $this->userService->getAllLocalsForHome();
        return view('home', compact('local'));
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
        
        return view('localfull', compact('local'));
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