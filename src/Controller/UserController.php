<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\UserDto;
use App\Entity\User;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class UserController extends AbstractController
{
    #[Route('/user', name: 'create', methods: ['POST'], format: 'JSON')]
    public function create(
        #[MapRequestPayload] UserDto $userDto,
        UserService                  $userService,
    ): Response
    {
        $userService->save($userDto);
        return new Response('', Response::HTTP_CREATED);
    }

    #[Route('/user', name: 'update', methods: ['PUT'], format: 'JSON')]
    public function update(
        #[MapRequestPayload] UserDto $userDto,
        #[CurrentUser] User          $user,
        Security                     $security,
        UserService                  $userService,
    ): Response
    {
        dump($user); die;
        $security->login($user);
        //todo check jwt
        $userService->save($userDto);
        return new Response('', Response::HTTP_CREATED);
    }
}
