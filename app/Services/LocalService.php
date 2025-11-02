<?php

namespace App\Services;

use App\Models\Local;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use RuntimeException;

class LocalService
{
    private static ?LocalService $instance = null;
    private array $allowedExtensions = ['jpg','png'];
    private int $maxFileSize = 5 * 1024 * 1024;

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

        $uploadedFiles = $request->file('images') ?? [];
        $local->images = $this->processAndSaveImages($uploadedFiles);
        $local->working_hours = $this->processWorkingHours($request);

        // Usuário que criou
        $user = Auth::user();
        if ($user) {
            $local->user_name = $user->name;
            $local->user_id = $user->id;
        }

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
        $user = Auth::user();
        if ($user) {
            $local->user_name = $user->name;
            $local->user_id = $user->id;
        }

        $local->save();

        return $local;
    }

    /**
     * Exclui um local e suas imagens
     */
    public function deleteLocal($id): bool
    {
        $local = Local::findOrFail($id);

        if (!empty($local->images) && is_array($local->images)) {
            foreach ($local->images as $image) {
                $path = public_path('img/' . $image);
                if (file_exists($path)) {
                    @unlink($path);
                }
            }
        }

        return $local->delete();
    }

    public function processAndSaveImages(array $files): array
    {
        $saved = [];

        if (empty($files)) {
            return $saved;
        }

        $dir = public_path('img');
        if (!is_dir($dir)) {
            if (!@mkdir($dir, 0755, true) && !is_dir($dir)) {
                throw new RuntimeException("Não foi possível criar o diretório de imagens em {$dir}");
            }
        }

        foreach ($files as $file) {
            if (!($file instanceof UploadedFile)) {
                continue;
            }

            if (!$file->isValid()) {
                continue;
            }

            $ext = strtolower($file->getClientOriginalExtension());
            if (!in_array($ext, $this->allowedExtensions, true)) {
                continue;
            }

            if ($file->getSize() > $this->maxFileSize) {
                continue;
            }

            $imageName = time() . '_' . uniqid() . '.' . $ext;
            $file->move($dir, $imageName);
            $saved[] = $imageName;
        }

        return $saved;
    }

    public function processImagesForUpdate(Request $request, Local $local): array
    {
        $images = $local->images ?? [];

        // Remover imagens selecionadas
        if ($request->filled('images_to_remove')) {
            $toRemove = array_filter(array_map('trim', explode(',', $request->images_to_remove)));
            foreach ($toRemove as $remove) {
                $path = public_path('img/' . $remove);
                if (file_exists($path)) {
                    @unlink($path);
                }
                $images = array_filter($images, fn($img) => $img !== $remove);
            }
        }

        // Adicionar novas imagens
        $newFiles = $request->file('images') ?? [];
        $added = $this->processAndSaveImages($newFiles);
        $images = array_values(array_merge($images, $added));

        return $images;
    }

    /**
     * Monta os horários de funcionamento
     */
    private function processWorkingHours(Request $request): array
    {
        $workingHours = [];

        if ($request->filled('working_days')) {
            foreach ($request->input('working_days', []) as $day) {
                $workingHours[$day] = [
                    'opening' => $request->input('opening_time_' . $day),
                    'closing' => $request->input('closing_time_' . $day)
                ];
            }
        }

        return $workingHours;
    }
}
