<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

final class AuthController extends AbstractController
{
    #[Route('/login', name: 'login', methods: ['POST'], format: 'JSON')]
    public function login(#[CurrentUser] User $user): JsonResponse
    {
        return new JsonResponse([
            'user' => $user->getUserIdentifier(),
            'token' => 1
        ], Response::HTTP_OK);
    }
}
