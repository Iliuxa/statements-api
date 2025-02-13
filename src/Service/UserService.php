<?php

namespace App\Service;

use AllowDynamicProperties;
use App\Dto\LoginDto;
use App\Dto\UserDto;
use App\Entity\User;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
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

    public function save(UserDTO $dto, bool $isAdmin): void
    {
        try {
            $user = empty($dto->id) ? new User() : $this->userRepository->find($dto->id);
            $user
                ->setName($dto->name)
                ->setAddress($dto->address)
                ->setEmail($dto->email)
                ->setPhone($dto->phone)
                ->setBirthday(DateTime::createFromFormat('Y-m-d', $dto->birthday))
                ->setRoles($isAdmin ? $dto->roles : $user->getRoles())
                ->setPassword($this->passwordHasher->hashPassword($user, $dto->password));

            $this->em->persist($user);
            $this->em->flush();
        } catch (Exception $exception) {
            // todo logger
            throw new Exception('Error saving user.');
        }
    }

    public function delete(User $user): void
    {
        try {
            $this->em->remove($user);
            $this->em->flush();
        } catch (Exception $exception) {
            // todo logger
            throw new Exception('Error saving user.');
        }
    }

    public function getAll(): array
    {
        try {
            return $this->userRepository->findAll();
        } catch (Exception $exception) {
            // todo logger
            throw new Exception('Error saving user.');
        }
    }
}