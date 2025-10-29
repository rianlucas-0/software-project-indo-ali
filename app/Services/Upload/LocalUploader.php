<?php

namespace App\Services\Upload;

use App\Contracts\UploaderInterface;
use App\Services\LocalService;

class LocalUploader implements UploaderInterface
{
    protected LocalService $localService;

    public function __construct(LocalService $localService)
    {
        $this->localService = $localService;
    }

    public function upload(array $files): array
    {
        return $this->localService->processAndSaveImages($files);
    }
}
