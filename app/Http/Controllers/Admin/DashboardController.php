<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Local;
use App\Models\ViewHistory;
use App\Models\Favorite;
use App\Models\Comment;

class DashboardController extends Controller
{
    /**
     * Mostra o dashboard do admin com estatísticas e dados para gráficos.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Pega todos os locais do admin autenticado
        $locals = Local::where('user_id', $user->id)->get();

        // Estatísticas simples
        $totalLocals = $locals->count();
        $activeLocals = $locals->where('is_active', true)->count();
        $inactiveLocals = $totalLocals - $activeLocals;

        // Dados por local: views (últimos 30 dias), favorites count, avg rating
    $labels = [];
    $localIds = [];
    $viewsData = [];
    $favoritesData = [];
    $avgRatingData = [];

        $thirtyDaysAgo = now()->subDays(30);

        foreach ($locals as $local) {
            $labels[] = $local->title;
            $localIds[] = $local->id;

            $viewsCount = ViewHistory::where('location_id', $local->id)
                ->where('viewed_at', '>=', $thirtyDaysAgo)
                ->count();
            $viewsData[] = $viewsCount;

            $favoritesCount = Favorite::where('location_id', $local->id)->count();
            $favoritesData[] = $favoritesCount;

            $avgRating = $local->comments()->avg('rating') ?? 0;
            $avgRatingData[] = round((float) $avgRating, 2);
        }

        // Dados agregados rápidos para mostrar no topo
        $totalViewsLast30 = ViewHistory::whereIn('location_id', $locals->pluck('id'))->where('viewed_at', '>=', $thirtyDaysAgo)->count();
        $totalFavorites = Favorite::whereIn('location_id', $locals->pluck('id'))->count();

        return view('admin.dashboard', compact(
            'totalLocals', 'activeLocals', 'inactiveLocals',
            'labels', 'localIds', 'viewsData', 'favoritesData', 'avgRatingData',
            'totalViewsLast30', 'totalFavorites'
        ));
    }
}
