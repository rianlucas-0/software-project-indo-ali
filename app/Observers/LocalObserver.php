<?php

namespace App\Observers;

use App\Models\Local;
use App\Services\RecommendationService;

class LocalObserver
{
    protected RecommendationService $recommendationService;

    public function __construct(RecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }

    public function created(Local $local): void
    {
        // Talvez atualizar recomendações gerais ou notificações
        $this->recommendationService->notifyNewLocal($local);
    }

    public function updated(Local $local): void
    {
        $this->recommendationService->updateRecommendationsForLocal($local);
    }
}
