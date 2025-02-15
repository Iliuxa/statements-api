<?php

namespace App\Service;

use App\Dto\UserDto;
use App\Entity\User;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use LogicException;
use Psr\Log\LoggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(
        private readonly EntityManagerInterface      $em,
        private readonly UserRepository              $userRepository,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly LoggerInterface             $logger,
    )
    {
    }

    public function save(UserDTO $dto, bool $isAdmin): void
    {
        try {
            $user = $dto->id === null ? new User() : $this->userRepository->find($dto->id);
            $user
                ->setName($dto->name)
                ->setAddress($dto->address)
                ->setEmail($dto->email)
                ->setPhone($dto->phone)
                ->setBirthday(DateTime::createFromFormat('Y-m-d', $dto->birthday))
                ->setRoles($isAdmin ? $dto->roles : $user->getRoles())
                ->setPassword($this->passwordHasher->hashPassword($user, $dto->password))
                ->setInsertDate(new DateTime());

            $this->em->persist($user);
            $this->em->flush();
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw new Exception('Error saving user.');
        }
    }

    public function delete(User $user): void
    {
        if (!$user->getStatements()->isEmpty()) {
            throw new LogicException('Cannot be deleted. The user has statements.');
        }
        try {
            $this->em->remove($user);
            $this->em->flush();
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw new Exception('Error deleting user.');
        }
    }

    public function getAll(): array
    {
        try {
            return $this->userRepository->findAll();
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw new Exception('Error getting users.');
        }
    }
}