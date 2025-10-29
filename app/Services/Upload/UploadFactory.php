<?php

namespace App\Services\Upload;

use App\Services\LocalService;
use InvalidArgumentException;

class UploadFactory
{
    public static function make(string $driver, LocalService $localService)
    {
        switch (strtolower($driver)) {
            case 'local':
            default:
                return new LocalUploader($localService);
        }

        throw new InvalidArgumentException("Upload driver {$driver} não suportado.");
    }
}
