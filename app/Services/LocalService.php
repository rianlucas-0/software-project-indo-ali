<?php

namespace App\Services;

use App\Models\Local;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LocalService
{
    // Instância única do serviço
    private static ?LocalService $instance = null;

    // Construtor privado impede instanciamento externo
    private function __construct() {}

    // Método público para obter a instância única
    public static function getInstance(): LocalService
    {
        if (self::$instance === null) {
            self::$instance = new LocalService();
        }
        return self::$instance;
    }

    // Impede clonagem
    public function __clone()
    {
        throw new \Exception("Cannot clone a singleton.");
    }

    // Impede serialização / desserialização
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    /**
     * Cria um novo local
     */
    public function createLocal(Request $request): Local
    {
        $local = new Local();

        // Dados básicos e endereço
        $local->title = $request->title;
        $local->description = $request->description;
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

        // Imagens e horários
        $local->images = $this->processImages($request);
        $local->working_hours = $this->processWorkingHours($request);

        // Usuário que criou
        $local->user_name = Auth::user()->name;
        $local->user_id = Auth::user()->id;

        $local->save();

        return $local;
    }

    /**
     * Atualiza um local existente
     */
    public function updateLocal(Request $request, $id): Local
    {
        $local = Local::findOrFail($id);

        $local->title = $request->title;
        $local->description = $request->description;
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

        // Atualiza imagens e horários
        $local->images = $this->processImagesForUpdate($request, $local);
        $local->working_hours = $this->processWorkingHours($request);

        // Usuário que atualizou
        $local->user_name = Auth::user()->name;
        $local->user_id = Auth::user()->id;

        $local->save();

        return $local;
    }

    /**
     * Processa upload de imagens na criação
     */
    private function processImages(Request $request): array
    {
        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('img', $imageName);
                $images[] = $imageName;
            }
        }

        return $images;
    }

    /**
     * Processa imagens para atualização (remover e adicionar)
     */
    private function processImagesForUpdate(Request $request, Local $local): array
    {
        $images = $local->images ?? [];

        // Remover imagens selecionadas
        if ($request->filled('images_to_remove')) {
            $toRemove = explode(',', $request->images_to_remove);
            foreach ($toRemove as $remove) {
                if (file_exists(public_path('img/' . $remove))) {
                    unlink(public_path('img/' . $remove));
                }
                $images = array_filter($images, fn($img) => $img !== $remove);
            }
        }

        // Adicionar novas imagens
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('img'), $imageName);
                $images[] = $imageName;
            }
        }

        return array_values($images);
    }

    /**
     * Monta os horários de funcionamento
     */
    private function processWorkingHours(Request $request): array
    {
        $workingHours = [];

        if ($request->working_days) {
            foreach ($request->working_days as $day) {
                $workingHours[$day] = [
                    'opening' => $request->input('opening_time_' . $day),
                    'closing' => $request->input('closing_time_' . $day)
                ];
            }
        }

        return $workingHours;
    }

    /**
     * Exclui um local e suas imagens
     */
    public function deleteLocal($id): bool
    {
        $local = Local::findOrFail($id);

        if (!empty($local->images)) {
            foreach ($local->images as $image) {
                if (file_exists(public_path('img/' . $image))) {
                    unlink(public_path('img/' . $image));
                }
            }
        }

        return $local->delete();
    }
}
