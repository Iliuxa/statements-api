<?php

namespace App\Service\Storage;

use App\Entity\StorageFile;
use App\Exception\StorageException;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class StorageService implements StorageInterface
{
    private const storageDirectory = '/storage';
    private const tmpDirectory = '/tmp/';

    public function __construct(
        private readonly EntityManagerInterface $em,
    )
    {
    }

    public function saveBase64(string $base64, string $fileName): int
    {
        try {
            // todo проверка типа файла
            $parts = explode(';', $base64, 2);
            $file = base64_decode($parts[1]);
            $storagePath = $this->getPath($fileName);
            file_put_contents($storagePath, $file);

            $storageFile = (new StorageFile())
                ->setName($fileName)
                ->setPath($storagePath)
                ->setHash($this->getFileHash($file))
                ->setUid(bin2hex(random_bytes(32)));

            $this->em->persist($storageFile);
            $this->em->flush();

            return $storageFile->getId();
        } catch (Exception $exception) {
            unlink($storagePath);
            throw new StorageException('Saving file error: ' . $exception->getMessage());
        }
    }

    public function download(int $fileId): void
    {
        try {
            $storageFile = $this->em->find(StorageFile::class, $fileId)
                ?? throw new StorageException('File not found.');

            $file = file_get_contents($storageFile->getPath());
            $hash = $this->getFileHash($file);
            if ($hash !== $storageFile->getHash()) {
                throw new StorageException('File is corrupted');
            }

            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $storageFile->getName() . '"');
            header('Content-Length: ' . strlen($file));

            echo $file;
        } catch (Exception $exception) {
            throw new StorageException('Receiving file error: ' . $exception->getMessage());
        }
    }

    /**
     * Получение(создание) директории для хранения файла
     * @param string $name
     * @return string
     * @throws \Random\RandomException
     */
    private function getPath(string $name): string
    {
        $date = new DateTime();
        $path = self::storageDirectory . $date->format('/Y/m/d/');
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $path .= bin2hex(random_bytes(10)) . $name;
        return $path;
    }

    /**
     * Получение хэша файла
     * @param string $file
     * @return string
     */
    private function getFileHash(string $file): string
    {
        try {
            $tmpName = self::tmpDirectory . bin2hex(random_bytes(10));
            file_put_contents($tmpName, $file);

            return hash_file('sha256', $tmpName);
        } catch (Exception $exception) {
            throw new StorageException('File hash creation error: ' . $exception->getMessage());
        } finally {
            unlink($tmpName);
        }
    }
}