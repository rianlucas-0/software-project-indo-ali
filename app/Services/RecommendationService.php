<?php

namespace App\Services;

use App\Models\Local;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Services\RecommendationStrategies\RecommendationStrategyInterface;
use App\Services\RecommendationStrategies\DefaultRecommendationStrategy;

class RecommendationService
{
    private static ?RecommendationService $instance = null;
    private RecommendationStrategyInterface $strategy;

    private function __construct()
    {
        $this->strategy = new DefaultRecommendationStrategy();
    }

    public static function getInstance(): RecommendationService
    {
        if (self::$instance === null) {
            self::$instance = new RecommendationService();
        }
        return self::$instance;
    }

    public function __clone() {}
    public function __wakeup() {}

    public function setStrategy(RecommendationStrategyInterface $strategy): void
    {
        $this->strategy = $strategy;
    }

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

        $scored = $this->strategy->calculate($locals, $userId, $preferences);

        return $scored->sortByDesc('recommendation_score')
                      ->take($limit)
                      ->values();
    }
}