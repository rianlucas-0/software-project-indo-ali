<?php

namespace App\Http\Controllers;

use App\Services\FavoriteService;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    protected $favoriteService;

    public function __construct()
    {
        $this->favoriteService = FavoriteService::getInstance();
    }

    /**
     * Lista os locais favoritados pelo usuário autenticado
     */
    public function index(): View
    {
        $favorites = $this->favoriteService->getUserFavorites(Auth::id());
        return view('favorites.index', compact('favorites'));
    }

    /**
     * Alterna o estado de favorito de um local para o usuário logado
     */
    public function toggle(Request $request, $locationId): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Usuário não autenticado'], 401);
        }

        $result = $this->favoriteService->toggleFavorite(Auth::id(), $locationId);
        
        return response()->json(['favorited' => $result['favorited']]);
    }

    /**
     * Verifica se um local já está favoritado pelo usuário atual
     */
    public function check($locationId): JsonResponse
    {
        $isFavorited = Auth::check() 
            ? $this->favoriteService->isLocationFavorited(Auth::id(), $locationId)
            : false;

        return response()->json(['favorited' => $isFavorited]);
    }

    /**
     * Remove um favorito específico da lista do usuário
     */
    public function remove($favoriteId): RedirectResponse
    {
        $result = $this->favoriteService->removeFavorite(Auth::id(), $favoriteId);
        
        if (!$result) {
            return redirect()->route('favorites.index')
                ->with('error', 'Favorito não encontrado!');
        }

        return redirect()->route('favorites.index')
            ->with('success', 'Removido dos favoritos!');
    }
}