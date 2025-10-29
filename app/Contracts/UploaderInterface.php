<?php

namespace App\Contracts;

interface UploaderInterface
{
    /**
     * Recebe um array de UploadedFile e retorna array de nomes salvos.
     *
     * @param array $files
     * @return array
     */
    public function upload(array $files): array;
}
