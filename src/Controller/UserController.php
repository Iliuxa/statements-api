<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\UserDto;
use App\Entity\User;
use App\Service\UserService;
use App\Thesaurus\Role;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[OA\Info(
    version: '1.0',
    description: "API documentation for statements system API",
    title: "Statements API",
)]
#[OA\Post(
    path: "/login_check",
    summary: "Аутентификация и получение JWT-токена",
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "username", type: "string", example: "admin@example.com"),
                new OA\Property(property: "password", type: "string", format: "password", example: "admin123")
            ],
            type: "object"
        )
    ),
    tags: ['login'],
    responses: [
        new OA\Response(
            response: 200,
            description: "Success",
            content: new OA\JsonContent(
                properties: [new OA\Property(property: "token", type: "string", example: "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...")],
                type: "object"
            )
        ),
        new OA\Response(response: 401, description: "Authentication error")
    ]
)]
class UserController extends AbstractController
{
    public function __construct(
        private readonly UserService $service
    )
    {
    }

    #[OA\Post(
        path: "/register",
        summary: "Создание нового пользователя",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/UserDto")
        ),
        tags: ['user'],
        responses: [
            new OA\Response(response: 201, description: "Success"),
            new OA\Response(response: 500, description: 'Runtime exception'),
        ]
    )]
    #[Route('/register', name: 'register_user', methods: ['POST'], format: 'JSON')]
    public function create(#[MapRequestPayload] UserDto $userDto): Response
    {
        $this->service->save($userDto, $this->isGranted(Role::Admin->value));
        return new Response('', Response::HTTP_CREATED);
    }

    #[OA\Put(
        path: "/user",
        summary: "Изменение пользователя",
        security: [["BearerAuth" => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/UserDto")
        ),
        tags: ['user'],
        responses: [
            new OA\Response(response: 200, description: "Success"),
            new OA\Response(response: 403, description: 'Access denied'),
            new OA\Response(response: 500, description: 'Runtime exception'),
        ]
    )]
    #[Route('/user', name: 'update_user', methods: ['PUT'], format: 'JSON')]
    public function update(#[MapRequestPayload] UserDto $userDto): Response
    {
        if (!$this->isGranted(Role::Admin->value) && $this->getUser()->getId() !== $userDto->id) {
            throw new AccessDeniedHttpException();
        }
        $this->service->save($userDto, $this->isGranted(Role::Admin->value));
        return new Response();
    }

    #[OA\Delete(
        path: '/user/{id}',
        summary: 'Удаление пользователя по id',
        security: [["BearerAuth" => []]],
        tags: ['user'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Идентификатор пользователя",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 123)
            )
        ],
        responses: [
            new OA\Response(response: 200, description: "Success"),
            new OA\Response(response: 403, description: 'Access denied'),
            new OA\Response(response: 404, description: 'Not found'),
            new OA\Response(response: 500, description: 'Runtime exception'),
        ]
    )]
    #[IsGranted(Role::Admin->value)]
    #[Route('/user/{id}', name: 'delete_user', methods: ['DELETE'], format: 'JSON')]
    public function delete(User $user): Response
    {
        $this->service->delete($user);
        return new Response();
    }

    #[OA\Get(
        path: '/user/{id}',
        summary: 'Получение информации о пользователе по id',
        security: [["BearerAuth" => []]],
        tags: ['user'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Идентификатор пользователя",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 123)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'User information',
                content: new OA\JsonContent(ref: "#/components/schemas/User")
            ),
            new OA\Response(response: 403, description: 'Access denied'),
            new OA\Response(response: 404, description: 'Not found'),
        ]
    )]
    #[Route('/user/{id}', name: 'get_user', methods: ['GET'], format: 'JSON')]
    public function get(User $user): JsonResponse
    {
        if (!$this->isGranted(Role::Admin->value) && $this->getUser()->getId() !== $user->getId()) {
            throw new AccessDeniedHttpException();
        }
        return $this->json($user);
    }

    #[OA\Get(
        path: '/user',
        summary: 'Получение информации о пользователях',
        security: [["BearerAuth" => []]],
        tags: ['user'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Users information',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: "#/components/schemas/User")
                )
            ),
            new OA\Response(response: 403, description: 'Access denied'),
            new OA\Response(response: 500, description: 'Runtime exception'),
        ]
    )]
    #[IsGranted(Role::Admin->value)]
    #[Route('/user', name: 'get_all_users', methods: ['GET'], format: 'JSON')]
    public function getAll(): JsonResponse
    {
        return $this->json($this->service->getAll());
    }
}
