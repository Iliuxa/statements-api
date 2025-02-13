<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\UserDto;
use App\Entity\User;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class UserController extends AbstractController
{
    public function __construct(
        private readonly UserService $service
    )
    {
    }

    #[Route('/register', name: 'register', methods: ['POST'], format: 'JSON')]
    public function create(#[MapRequestPayload] UserDto $userDto): Response
    {
        $this->service->save($userDto, $this->isGranted('ROLE_ADMIN'));
        return new Response('', Response::HTTP_CREATED);
    }

    #[Route('/user', name: 'update', methods: ['PUT'], format: 'JSON')]
    public function update(#[MapRequestPayload] UserDto $userDto): Response
    {
        $this->service->save($userDto, $this->isGranted('ROLE_ADMIN'));
        return new Response('', Response::HTTP_CREATED);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/user/{id}', name: 'delete', methods: ['DELETE'], format: 'JSON')]
    public function delete(User $user): Response
    {
        $this->service->delete($user);
        return new Response('', Response::HTTP_CREATED);
    }

    #[Route('/user/{id}', name: 'get', methods: ['GET'], format: 'JSON')]
    public function get(User $user): JsonResponse
    {
        return $this->json($user);
    }

    #[Route('/user', name: 'getAll', methods: ['GET'], format: 'JSON')]
    public function getAll(): JsonResponse
    {
        return $this->json($this->service->getAll());
    }
}
