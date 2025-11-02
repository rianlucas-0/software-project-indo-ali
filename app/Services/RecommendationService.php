<?php

namespace App\Services;

use App\Models\Local;
use App\Models\UserPreference;
use App\Models\Favorite;
use App\Models\ViewHistory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Services\RecommendationStrategies\RecommendationStrategyInterface;
use App\Services\RecommendationStrategies\DefaultRecommendationStrategy;

class RecommendationService
{
    private static ?RecommendationService $instance = null;
    private RecommendationStrategyInterface $strategy;

    // tempo de cache padrão em minutos
    private int $cacheTtlMinutes = 60;

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

    /**
     * Retorna recomendações para um usuário.
     * Primeiro tenta usar cache; se não existir, calcula, armazena no cache e retorna.
     */
    public function getRecommendationsForUser(int $userId, int $limit = 12): Collection
    {
        $cacheKey = $this->getUserCacheKey($userId);

        $cached = Cache::get($cacheKey);
        if ($cached instanceof Collection) {
            return $cached->take($limit)->values();
        }

        // não havia cache -> calcular normalmente
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

        $result = $scored->sortByDesc('recommendation_score')
                        ->take($limit)
                        ->values();

        Cache::put($cacheKey, $result, now()->addMinutes($this->cacheTtlMinutes));

        return $result;
    }

    /**
     * Invalida cache das recomendações de um usuário
     */
    public function invalidateUserCache(int $userId): void
    {
        Cache::forget($this->getUserCacheKey($userId));
    }

    /**
     * Invalida caches relacionados a um local:
     * - usuários que favoritaram o local
     * Observers podem chamar este método quando um comentário/avaliação/imagem altere o local.
     */
    public function invalidateLocalRelatedCaches(int $localId): void
    {
        // usuários que favoritaram
        $userIds = Favorite::where('location_id', $localId)->pluck('user_id')->toArray();

        // adicionar usuários que visualizaram
        $viewerIds = ViewHistory::where('location_id', $localId)->pluck('user_id')->toArray();

        $allUserIds = array_unique(array_merge($userIds, $viewerIds));

        foreach ($allUserIds as $userId) {
            $this->invalidateUserCache((int) $userId);
        }
    }

    /**
     * Recalcula e armazena em cache as recomendações para uma lista de usuários.
     */
    public function recomputeForUsers(array $userIds, int $limit = 12): void
    {
        foreach ($userIds as $userId) {
            $recs = $this->getRecommendationsForUser((int) $userId, $limit);
            // getRecommendationsForUser já armazena no cache, mas garantimos aqui
            Cache::put($this->getUserCacheKey((int) $userId), $recs, now()->addMinutes($this->cacheTtlMinutes));
        }
    }

    /**
     * Helper para criar a chave de cache por usuário
     */
    private function getUserCacheKey(int $userId): string
    {
        return "user_recommendations_{$userId}";
    }

    /**
     * Permite ajustar TTL do cache em minutos
     */
    public function setCacheTtlMinutes(int $minutes): void
    {
        $this->cacheTtlMinutes = max(1, $minutes);
    }
}
