<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Исключение, текст которого выбрасывается клиенту
 */
class ApiException extends HttpException
{
    public function __construct(string $message, int $statusCode = 500)
    {
        parent::__construct($statusCode, $message);
    }
}