<?php

namespace App\Observers;

use App\Models\Comment;
use App\Services\RecommendationService;

class CommentObserver
{
    protected RecommendationService $recommendationService;

    public function __construct(RecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }

    public function created(Comment $comment): void
    {
        // Atualiza recomendações para o usuário ou local
        $this->recommendationService->updateRecommendationsForUser($comment->user);
        $this->recommendationService->updateRecommendationsForLocal($comment->local);
    }

    public function updated(Comment $comment): void
    {
        // Atualiza recomendações se necessário
        $this->recommendationService->updateRecommendationsForLocal($comment->local);
    }
}
