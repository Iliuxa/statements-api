<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\UserDto;
use App\Entity\User;
use App\Service\UserService;
use App\Thesaurus\Role;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class UserController extends AbstractController
{
    public function __construct(
        private readonly UserService $service
    )
    {
    }

    #[Route('/register', name: 'register_user', methods: ['POST'], format: 'JSON')]
    public function create(#[MapRequestPayload] UserDto $userDto): Response
    {
        $this->service->save($userDto, $this->isGranted(Role::Admin->value));
        return new Response('', Response::HTTP_CREATED);
    }

    #[Route('/user', name: 'update_user', methods: ['PUT'], format: 'JSON')]
    public function update(#[MapRequestPayload] UserDto $userDto): Response
    {
        if (!$this->isGranted(Role::Admin->value) && $this->getUser()->getId() !== $userDto->id) {
            throw new AccessDeniedHttpException();
        }
        $this->service->save($userDto, $this->isGranted(Role::Admin->value));
        return new Response();
    }

    #[IsGranted(Role::Admin->value)]
    #[Route('/user/{id}', name: 'delete_user', methods: ['DELETE'], format: 'JSON')]
    public function delete(User $user): Response
    {
        $this->service->delete($user);
        return new Response();
    }

    #[Route('/user/{id}', name: 'get_user', methods: ['GET'], format: 'JSON')]
    public function get(User $user): JsonResponse
    {
        if (!$this->isGranted(Role::Admin->value) && $this->getUser()->getId() !== $user->getId()) {
            throw new AccessDeniedHttpException();
        }
        return $this->json($user);
    }

    #[IsGranted(Role::Admin->value)]
    #[Route('/user', name: 'get_all_users', methods: ['GET'], format: 'JSON')]
    public function getAll(): JsonResponse
    {
        return $this->json($this->service->getAll());
    }
}
