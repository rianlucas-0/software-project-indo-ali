<?php

namespace App\Http\Controllers;

use App\Models\UserPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PreferencesController extends Controller
{
    public function edit(): View
    {
        $prefs = UserPreference::firstOrCreate(['user_id' => Auth::id()], []);
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

        $prefs = UserPreference::firstOrCreate(['user_id' => Auth::id()], []);
        $prefs->fill($data);
        $prefs->save();

        return redirect()->route('preferences.edit')->with('success', 'Preferências salvas!');
    }
}


