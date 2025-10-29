<?php

namespace App\Services\RecommendationStrategies;

use Illuminate\Support\Collection;
use App\Models\Local;

interface RecommendationStrategyInterface
{
    public function calculate(Collection $locals, int $userId, ?object $preferences = null): Collection;
}
