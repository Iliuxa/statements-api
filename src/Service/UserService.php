<?php

namespace App\Service;

use App\Dto\UserDto;
use App\Entity\User;
use App\Exception\ApiException;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
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

    /**
     * Создание и изменение пользователя
     * @param UserDto $dto
     * @param bool $isAdmin
     * @return void
     */
    public function save(UserDTO $dto, bool $isAdmin): void
    {
        $users = $this->userRepository->getAnotherUsersByEmailOrPhone($dto->id, $dto->email, $dto->phone);
        if (!empty($users)) {
            throw new ApiException('User with such mail or phone already exists');
        }

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
            throw new ApiException('Error saving user.');
        }
    }

    /**
     * Удаление пользователя
     * @param User $user
     * @return void
     */
    public function delete(User $user): void
    {
        if (!$user->getStatements()->isEmpty()) {
            throw new ApiException('Cannot be deleted. The user has statements.');
        }
        try {
            $this->em->remove($user);
            $this->em->flush();
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw new ApiException('Error deleting user.');
        }
    }

    /**
     * Получение всех пользователей
     * @return User[]
     */
    public function getAll(): array
    {
        try {
            return $this->userRepository->findAll();
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw new ApiException('Error getting users.');
        }
    }
}