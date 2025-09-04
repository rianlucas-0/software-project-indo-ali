<?php

namespace App\Http\Controllers;

use App\Models\Local;
use App\Models\ViewHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Exibe dados na página inicial
     */
    public function showDataInHome(): View
    {
        $local = Local::all();
        return view('home', compact('local'));
    }

    /**
     * Redireciona usuário para o dashboard apropriado baseado no tipo de usuário
     */
    public function index(Request $request): View|RedirectResponse
    {
        if ($request->user()->user_type == 'admin') {
            return view('admin.dashboard');
        }

        return redirect()->route('dashboard');
    }

    /**
     * Redireciona usuário para o dashboard apropriado baseado no tipo de usuário
     */
    public function home(Request $request): View|RedirectResponse
    {
        if ($request->user()->user_type == 'user') {
            return view('dashboard');
        }

        return redirect()->route('admin.dashboard');
    }

    /**
     * Exibe detalhes completos de um local e registra no histórico de visualização
     */
    public function showFullLocal($id): View
    {
        $local = Local::findOrFail($id);
        
        // Registra visualização no histórico do usuário autenticado
        if (Auth::check()) {
            $existingView = ViewHistory::where('user_id', Auth::id())
                                ->where('location_id', $id)
                                ->first();
            
            if ($existingView) {
                $existingView->update(['viewed_at' => now()]);
            } else {
                ViewHistory::create([
                    'user_id' => Auth::id(),
                    'location_id' => $id,
                    'viewed_at' => now()
                ]);
            }
        }
        
        return view('localfull', compact('local'));
    }
    
    /**
     * Exibe o histórico de visualização do usuário com filtro de tempo opcional
     */
    public function showHistory(Request $request): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $filter = $request->input('filter', 'all');
        $query = ViewHistory::where('user_id', Auth::id())->with('location');
        
        // Aplica filtro de período
        switch ($filter) {
            case 'week':
                $query->where('viewed_at', '>=', now()->subWeek());
                break;
            case 'month':
                $query->where('viewed_at', '>=', now()->subMonth());
                break;
            case 'year':
                $query->where('viewed_at', '>=', now()->subYear());
                break;
        }
        
        $history = $query->orderBy('viewed_at', 'desc')->paginate(12);
        
        return view('history', compact('history', 'filter'));
    }

    /**
     * Limpa todo o histórico de visualização do usuário
     */
    public function clearHistory(): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        ViewHistory::where('user_id', Auth::id())->delete();
        
        return redirect()->route('history')->with('success', 'Histórico limpo com sucesso!');
    }

    /**
     * Remove um item específico do histórico de visualização
     */
    public function removeHistoryItem($id): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $historyItem = ViewHistory::where('user_id', Auth::id())->where('id', $id)->first();
        
        if ($historyItem) {
            $historyItem->delete();
            return redirect()->route('history')->with('success', 'Item removido do histórico!');
        }
        
        return redirect()->route('history')->with('error', 'Item não encontrado!');
    }
}