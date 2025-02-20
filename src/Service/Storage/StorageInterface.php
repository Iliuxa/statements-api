<?php

namespace App\Service\Storage;

interface StorageInterface
{
    /**
     * Сохранение base64 файла
     * @param string $base64
     * @param string $fileName
     * @return int - id файла
     */
    public function saveBase64(string $base64, string $fileName): int;

    /**
     * Скачивание файла
     * @param int $fileId
     * @return void
     */
    public function download(int $fileId): void;
}