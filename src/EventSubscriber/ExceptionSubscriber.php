<?php

namespace App\EventSubscriber;

use App\Exception\ApiException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => [
                ['processException', 10],
            ],
        ];
    }

    /**
     * Отправка сообщения об ошибке пользователю
     * @param ExceptionEvent $event
     * @return void
     * @throws \Throwable
     */
    public function processException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        if (!$exception instanceof ApiException) {
            throw new $exception;
        }

        $event->setResponse(new JsonResponse([
            'error' => $exception->getMessage(),
        ], $exception->getStatusCode()));
    }
}