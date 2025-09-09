<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Local;

class SearchController extends Controller
{
    /**
     * Show search results with filters.
     */
    public function index(Request $request)
{
    $query = Local::query()->active();

    if ($request->filled('q')) {
        $query->where(function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->q . '%')
            ->orWhere('description', 'like', '%' . $request->q . '%');
        });
    }

    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    if ($request->filled('state')) {
        $query->where('state', $request->state);
    }

    if ($request->filled('city')) {
        $query->where('city', 'like', '%' . $request->city . '%');
    }

    if ($request->filled('features')) {
        foreach ($request->features as $feature) {
            $query->whereJsonContains('features', $feature);
        }
    }

    $locals = $query->paginate(20);
    return view('search.index', compact('locals'));
}
}
