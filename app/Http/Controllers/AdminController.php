<?php

namespace App\Http\Controllers;

use App\Models\Local;
use App\Services\LocalService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
    protected LocalService $localService;

    public function __construct()
    {
        $this->localService = LocalService::getInstance();
    }

    /**
     * Exibe o formulário de criação de local
     */
    public function addlocal(): View
    {
        return view('admin.add_local');
    }

    /**
     * Processa a criação de um novo local
     */
    public function createlocal(Request $request): RedirectResponse
    {
        try {
            $this->localService->createLocal($request);
            return redirect()->route('admin.addlocal')->with('status', 'Adicionado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar local: ' . $e->getMessage());
        }
    }

    /**
     * Lista todos os locais
     */
    public function all_local(): View
    {
        $local = Local::where('user_id', Auth::id())->get();
        return view('admin.all_local', compact('local'));
    }

    /**
     * Exibe formulário de edição de local
     */
    public function updatelocal($id): View
    {
        $local = Local::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('admin.updatelocal', compact('local'));
    }

    /**
     * Processa atualização de local existente
     */
    public function localupdate(Request $request, $id): RedirectResponse
    {
        try {
            $local = Local::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $this->localService->updateLocal($request, $local->id);

            return redirect()->route('admin.dashboard')->with('success', 'Local atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar local: ' . $e->getMessage());
        }
    }

    /**
     * Remove um local permanentemente
     */
    public function destroy($id): RedirectResponse
    {
        try {
            $local = Local::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $this->localService->deleteLocal($local->id);

            return redirect()->route('admin.dashboard')->with('success', 'Local excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao excluir local: ' . $e->getMessage());
        }
    }

}