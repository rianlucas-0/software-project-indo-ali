<?php

namespace App\Services;

use App\Models\Local;
use App\Models\ViewHistory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    /**
     * Obtém todos os locais para exibir na página inicial
     */
    public function getAllLocalsForHome()
    {
        return Local::all();
    }

    /**
     * Verifica o tipo de usuário e retorna a view apropriada
     */
    public function getUserDashboardType($user): string
    {
        return $user->user_type == 'admin' ? 'admin.dashboard' : 'dashboard';
    }

    /**
     * Registra uma visualização de local no histórico do usuário
     */
    public function registerLocalView(int $userId, int $locationId): void
    {
        $existingView = ViewHistory::where('user_id', $userId)
                            ->where('location_id', $locationId)
                            ->first();
        
        if ($existingView) {
            $existingView->update(['viewed_at' => now()]);
        } else {
            ViewHistory::create([
                'user_id' => $userId,
                'location_id' => $locationId,
                'viewed_at' => now()
            ]);
        }
    }

    /**
     * Obtém o histórico de visualização do usuário com filtro
     */
    public function getUserViewHistory(int $userId, string $filter = 'all'): LengthAwarePaginator
    {
        $query = ViewHistory::where('user_id', $userId)->with('location');
        
        $this->applyHistoryFilter($query, $filter);
        
        return $query->orderBy('viewed_at', 'desc')->paginate(12);
    }

    /**
     * Aplica filtro de período ao histórico
     */
    private function applyHistoryFilter($query, string $filter): void
    {
        switch ($filter) {
            case 'week':
                $query->where('viewed_at', '>=', now()->subWeek());
                break;
            case 'month':
                $query->where('viewed_at', '>=', now()->subMonth());
                break;
            case 'year':
                $query->where('viewed_at', '>=', now()->subYear());
                break;
        }
    }

    /**
     * Limpa todo o histórico de visualização do usuário
     */
    public function clearUserHistory(int $userId): void
    {
        ViewHistory::where('user_id', $userId)->delete();
    }

    /**
     * Remove um item específico do histórico
     */
    public function removeHistoryItem(int $userId, int $itemId): bool
    {
        $historyItem = ViewHistory::where('user_id', $userId)
            ->where('id', $itemId)
            ->first();
        
        if ($historyItem) {
            $historyItem->delete();
            return true;
        }
        
        return false;
    }
}