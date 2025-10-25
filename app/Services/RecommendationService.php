<?php

namespace App\Services;

use App\Models\Local;
use App\Models\UserPreference;
use App\Models\Favorite;
use App\Models\ViewHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class RecommendationService
{
    public function getRecommendationsForUser(int $userId, int $limit = 12): Collection
    {
        $preferences = UserPreference::where('user_id', $userId)->first();

        $query = Local::query()->active();

        if ($preferences) {
            if (!empty($preferences->preferred_categories)) {
                $query->whereIn('category', $preferences->preferred_categories);
            }

            if (!empty($preferences->preferred_state)) {
                $query->whereIn('city', $preferences->preferred_state);
            }

            if (!empty($preferences->preferred_features)) {
                foreach ($preferences->preferred_features as $feature) {
                    $query->whereJsonContains('features', $feature);
                }
            }
        }

        $locals = $query->get();

        $favoriteLocationIds = Favorite::where('user_id', $userId)->pluck('location_id')->toArray();
        $viewCounts = ViewHistory::where('user_id', $userId)
            ->selectRaw('location_id, COUNT(*) as views')
            ->groupBy('location_id')
            ->pluck('views', 'location_id');

        $scored = $locals->map(function (Local $local) use ($favoriteLocationIds, $viewCounts, $preferences) {
            $score = 0;

            if ($preferences) {
                if ($preferences->preferred_categories && in_array($local->category, $preferences->preferred_categories)) {
                    $score += 20;
                }
                if ($preferences->preferred_state && in_array($local->city, $preferences->preferred_state)) {
                    $score += 10;
                }
                if ($preferences->preferred_features) {
                    $localFeatures = (array) $local->features;
                    $matches = count(array_intersect($preferences->preferred_features, $localFeatures));
                    $score += $matches * 5;
                }
            }

            if (in_array($local->id, $favoriteLocationIds)) {
                $score += 30;
            }

            if ($viewCounts->has($local->id)) {
                $score += min(20, (int) $viewCounts->get($local->id));
            }

            $score += (int) $local->favorites()->count();
            $score += (int) round(($local->average_rating ?? 0) * 2);

            $local->recommendation_score = $score;
            return $local;
        });

        return $scored
            ->sortByDesc('recommendation_score')
            ->take($limit)
            ->values();
    }
}