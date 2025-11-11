<?php

namespace App\Http\Controllers;

use App\Models\UserPreference;
use App\Services\RecommendationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PreferencesController extends Controller
{
    protected $recommendationService;

    public function __construct()
    {
        $this->recommendationService = RecommendationService::getInstance();
    }

    public function edit(): View
    {
        $prefs = UserPreference::firstOrCreate(
            ['user_id' => Auth::id()], 
            [
                'preferred_categories' => [],
                'preferred_features' => [],
                'preferred_state' => [],
                'budget_range' => 'medium'
            ]
        );
        return view('preferences.edit', [
            'prefs' => $prefs,
        ]);
    }

    public function update(Request $request): RedirectResponse
{
    $data = $request->validate([
        'preferred_categories' => 'nullable|array',
        'preferred_categories.*' => 'string',
        'preferred_features' => 'nullable|array',
        'preferred_features.*' => 'string',
        'preferred_state' => 'nullable|array',
        'preferred_state.*' => 'string',
        'budget_range' => 'nullable|string|in:low,medium,high',
    ]);

    // Garantir que os arrays existam mesmo quando vazios
    $data['preferred_categories'] = $data['preferred_categories'] ?? [];
    $data['preferred_features'] = $data['preferred_features'] ?? [];
    $data['preferred_state'] = $data['preferred_state'] ?? [];
    $data['budget_range'] = $data['budget_range'] ?? 'medium';

    $prefs = UserPreference::firstOrCreate(
        ['user_id' => Auth::id()], 
        [
            'preferred_categories' => [],
            'preferred_features' => [],
            'preferred_state' => [],
            'budget_range' => 'medium'
        ]
    );
    
    $prefs->fill($data);
    $prefs->save();

    // Invalidar cache das recomendações
    $this->recommendationService->invalidateUserCache(Auth::id());

    return redirect()->route('preferences.edit')->with('success', 'Preferências salvas! Suas recomendações serão atualizadas em breve.');
}
}