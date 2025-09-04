<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Local;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    /**
     * Lista os locais favoritados pelo usuário autenticado
     */
    public function index(): View
    {
        $favorites = Favorite::with('location')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(12);
            
        return view('favorites.index', compact('favorites'));
    }

    /**
     * Alterna o estado de favorito de um local para o usuário logado
     * (adiciona se não existir, remove se já estiver favoritado)
     */
    public function toggle(Request $request, $locationId): JsonResponse
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Usuário não autenticado'], 401);
        }

        $favorite = Favorite::where('user_id', $user->id)
            ->where('location_id', $locationId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['favorited' => false]);
        }

        Favorite::create([
            'user_id' => $user->id,
            'location_id' => $locationId
        ]);

        return response()->json(['favorited' => true]);
    }

    /**
     * Verifica se um local já está favoritado pelo usuário atual
     */
    public function check($locationId): JsonResponse
    {
        $isFavorited = Auth::check() 
            ? Favorite::where('user_id', Auth::id())
                ->where('location_id', $locationId)
                ->exists()
            : false;

        return response()->json(['favorited' => $isFavorited]);
    }

    /**
     * Remove um favorito específico da lista do usuário
     */
    public function remove($favoriteId): RedirectResponse
    {
        $favorite = Favorite::where('user_id', Auth::id())
            ->where('id', $favoriteId)
            ->firstOrFail();

        $favorite->delete();

        return redirect()->route('favorites.index')
            ->with('success', 'Removido dos favoritos!');
    }
}
