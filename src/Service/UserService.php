<?php

namespace App\Service;

use AllowDynamicProperties;
use App\Dto\LoginDto;
use App\Dto\UserDto;
use App\Entity\User;
use App\Entity\UserRole;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AllowDynamicProperties]
class UserService
{
    public function __construct(
        private readonly EntityManagerInterface      $em,
        private readonly UserRepository              $userRepository,
        private readonly UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    public function save(UserDTO $dto): void
    {
        try {
            $user = empty($dto->id) ? new User() : $this->userRepository->find($dto->id);
            $user
                ->setName($dto->name)
                ->setAddress($dto->address)
                ->setEmail($dto->email)
                ->setPhone($dto->phone)
                ->setBirthday(DateTime::createFromFormat('Y-m-d', $dto->birthday))
                ->setRoles($user->getRoles())
                ->setPassword($this->passwordHasher->hashPassword($user, $dto->password));
            $this->em->persist($user);
            $this->em->flush();
        } catch (Exception) {
            // todo logger
            throw new Exception('Error saving user.');
        }
    }

    public function login(LoginDto $dto)
    {
        $user = $this->userRepository->findOneBy(['email' => $dto->email]);
        if (empty($user) || !$this->passwordHasher->isPasswordValid($user, $dto->password)) {
            throw new BadRequestHttpException();
        }


    }
}