<?php

namespace App\Services\RecommendationStrategies;

use Illuminate\Support\Collection;
use App\Models\Favorite;
use App\Models\ViewHistory;
use App\Models\Local;

class DefaultRecommendationStrategy implements RecommendationStrategyInterface
{
    public function calculate(Collection $locals, int $userId, ?object $preferences = null): Collection
    {
        $favoriteLocationIds = Favorite::where('user_id', $userId)->pluck('location_id')->toArray();
        $viewCounts = ViewHistory::where('user_id', $userId)
            ->selectRaw('location_id, COUNT(*) as views')
            ->groupBy('location_id')
            ->pluck('views', 'location_id');

        return $locals->map(function (Local $local) use ($favoriteLocationIds, $viewCounts, $preferences) {
            $score = 0;

            // Pontuação base (garante que todos tenham alguma pontuação)
            $score += 5;

            // Preferências do usuário (aumentar pesos)
            if ($preferences) {
                // Categorias preferidas - peso alto
                if (!empty($preferences->preferred_categories) && in_array($local->category, $preferences->preferred_categories)) {
                    $score += 30;
                }

                // Estados preferidos - peso médio
                if (!empty($preferences->preferred_state) && in_array($local->state, $preferences->preferred_state)) {
                    $score += 15;
                }

                // Características - peso variável por quantidade de matches
                if (!empty($preferences->preferred_features)) {
                    $localFeatures = (array) $local->features;
                    $matches = count(array_intersect($preferences->preferred_features, $localFeatures));
                    $score += $matches * 8; // Aumentei o peso
                }

                // Budget range - consideração adicional
                if ($preferences->budget_range) {
                    //Implementar lógica de budget aqui
                }
            }

            // Comportamento do usuário (favoritos)
            if (in_array($local->id, $favoriteLocationIds)) {
                $score += 40; // Aumentei o peso
            }

            // Histórico de visualizações
            if ($viewCounts->has($local->id)) {
                $views = (int) $viewCounts->get($local->id);
                $score += min(30, $views * 3); // Aumentei o peso
            }

            // Popularidade geral (favoritos totais)
            $totalFavorites = $local->favorites()->count();
            $score += min(25, $totalFavorites); // Limite para não dominar

            // Avaliação média
            $rating = $local->average_rating ?? 0;
            $score += (int) round($rating * 3); // Aumentei o peso

            // Bônus para locais recentes
            $daysSinceCreation = $local->created_at->diffInDays(now());
            if ($daysSinceCreation <= 30) {
                $score += 10; // Bônus para locais novos
            }

            $local->recommendation_score = $score;
            return $local;
        });
    }
}
