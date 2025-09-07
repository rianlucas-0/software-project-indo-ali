<?php

namespace App\Services;

use App\Models\Favorite;
use App\Models\Local;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class FavoriteService
{
    /**
     * Obtém todos os favoritos do usuário
     */
    public function getUserFavorites(int $userId): LengthAwarePaginator
    {
        return Favorite::with('location')
            ->where('user_id', $userId)
            ->latest()
            ->paginate(12);
    }

    /**
     * Alterna o estado de favorito de um local
     */
    public function toggleFavorite(int $userId, int $locationId): array
    {
        $favorite = Favorite::where('user_id', $userId)
            ->where('location_id', $locationId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return ['favorited' => false, 'action' => 'removed'];
        }

        Favorite::create([
            'user_id' => $userId,
            'location_id' => $locationId
        ]);

        return ['favorited' => true, 'action' => 'added'];
    }

    /**
     * Verifica se um local está favoritado
     */
    public function isLocationFavorited(int $userId, int $locationId): bool
    {
        return Favorite::where('user_id', $userId)
            ->where('location_id', $locationId)
            ->exists();
    }

    /**
     * Remove um favorito específico
     */
    public function removeFavorite(int $userId, int $favoriteId): bool
    {
        $favorite = Favorite::where('user_id', $userId)
            ->where('id', $favoriteId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return true;
        }

        return false;
    }

    /**
     * Obtém contagem de favoritos por usuário
     */
    public function getFavoriteCount(int $userId): int
    {
        return Favorite::where('user_id', $userId)->count();
    }
}