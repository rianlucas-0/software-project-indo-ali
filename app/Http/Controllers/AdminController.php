<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
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
        $local = new Local();
        $local->title = $request->title;
        $local->description = $request->description;

        // Processa upload de múltiplas imagens
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagename = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
                $image->move('img', $imagename);
                $images[] = $imagename;
            }
        }
        $local->images = $images;

        // Dados de endereço
        $local->cep = $request->cep;
        $local->address = $request->address;
        $local->address_number = $request->address_number;
        $local->neighborhood = $request->neighborhood;
        $local->city = $request->city;
        $local->state = $request->state;
        $local->phone = $request->phone;
        $local->contact_email = $request->contact_email;
        $local->category = $request->category;
        $local->features = $request->features;

        // Horários de funcionamento
        $workingHours = [];
        if ($request->working_days) {
            foreach ($request->working_days as $day) {
                $workingHours[$day] = [
                    'opening' => $request->input('opening_time_'.$day),
                    'closing' => $request->input('closing_time_'.$day)
                ];
            }
        }
        $local->working_hours = $workingHours;
        
        // Registro do usuário criador
        $local->user_name = Auth::user()->name;
        $local->user_id = Auth::user()->id;

        if ($local->save()) {
            return redirect()->route('admin.addlocal')->with('status', 'Adicionado com sucesso!');
        }
    }

    /**
     * Lista todos os locais
     */
    public function all_local(): View
    {
        $local = Local::all();
        return view('admin.all_local', compact('local'));
    }

    /**
     * Exibe formulário de edição de local
     */
    public function updatelocal($id): View
    {
        $local = Local::findOrFail($id);
        return view('admin.updatelocal', compact('local'));
    }

    /**
     * Processa atualização de local existente
     */
    public function localupdate(Request $request, $id): RedirectResponse
    {
        $local = Local::findOrFail($id);
        $local->title = $request->title;
        $local->description = $request->description;

        // Gerencia imagens - remove as selecionadas
        $images = $local->images ?? [];

        if ($request->filled('images_to_remove')) {
            $toRemove = explode(',', $request->images_to_remove);
            foreach ($toRemove as $remove) {
                if (file_exists(public_path('img/'.$remove))) {
                    unlink(public_path('img/'.$remove));
                }
                $images = array_filter($images, fn($img) => $img !== $remove);
            }
        }

        // Adiciona novas imagens
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagename = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('img'), $imagename);
                $images[] = $imagename;
            }
        }

        $local->images = array_values($images);
        
        // Atualiza dados de endereço
        $local->cep = $request->cep;
        $local->address = $request->address;
        $local->address_number = $request->address_number;
        $local->neighborhood = $request->neighborhood;
        $local->city = $request->city;
        $local->state = $request->state;
        $local->phone = $request->phone;
        $local->contact_email = $request->contact_email;
        $local->category = $request->category;
        $local->features = $request->features;

        // Atualiza horários de funcionamento
        $workingHours = [];
        if ($request->working_days) {
            foreach ($request->working_days as $day) {
                $workingHours[$day] = [
                    'opening' => $request->input('opening_time_'.$day),
                    'closing' => $request->input('closing_time_'.$day)
                ];
            }
        }
        $local->working_hours = $workingHours;
        
        // Registra usuário que realizou a atualização
        $local->user_name = Auth::user()->name;
        $local->user_id = Auth::user()->id;

        if ($local->save()) {
            return redirect()->route('admin.all_local', $id)->with('status', 'Atualizado com sucesso!');
        }
    }

    /**
     * Remove um local permanentemente
     */
    public function destroy($id): RedirectResponse
    {
        $local = Local::findOrFail($id);
        $local->delete();

        return redirect()->route('admin.all_local')->with('status', 'Deletado com sucesso');
    }
}