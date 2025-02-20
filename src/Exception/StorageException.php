<?php

namespace App\Exception;

use RuntimeException;

class StorageException extends RuntimeException
{
    public function __construct(string $message, int $statusCode = 500)
    {
        parent::__construct($message, $statusCode);
    }
}