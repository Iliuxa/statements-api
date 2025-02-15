<?php

namespace App\Tests\Integration\Service;

use App\Dto\StatementDto;
use App\Dto\UserDto;
use App\Entity\Statement;
use App\Entity\User;
use App\Service\StatementService;
use App\Service\UserService;
use App\Thesaurus\Role;
use Doctrine\ORM\EntityManagerInterface;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserServiceTest extends KernelTestCase
{
    private UserPasswordHasherInterface $passwordHasher;
    private EntityManagerInterface $entityManager;
    private UserService $userService;
    private StatementService $statementService;

    public function testSaveUser(): void
    {
        $dto = $this->getDefaultUserDto();

        /** Регистрация */
        $this->userService->save($dto, false);
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $dto->email]);
        $this->compareUser($dto, $user);

        /** Изменение */
        $dto->id = $user->getId();
        $dto->name = 'test2';
        $dto->email = 'test2@example.com';
        $this->userService->save($dto, true);
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $dto->email]);
        $this->compareUser($dto, $user);

        /** Изменение (попытка повысить привилегии) */
        $dto->roles = [Role::User->value, Role::Admin->value];
        $this->userService->save($dto, false);
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $dto->email]);
        self::assertEmpty(array_diff([Role::User->value], $user->getRoles()));
    }

    public function testDeleteUser(): void
    {
        /** Удаление  */
        $dto = $this->getDefaultUserDto();
        $this->userService->save($dto, false);
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $dto->email]);
        self::assertNotEmpty($user);

        $this->userService->delete($user);
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $dto->email]);
        self::assertEmpty($user);

        /** Удаление с существующими заявлениями */
        $this->userService->save($dto, false);
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $dto->email]);
        $this->statementService->save(new StatementDto(null, 'test', 'test', 'test', $user->getId()));
        $this->entityManager->refresh($user);

        $this->expectException(LogicException::class);
        $this->userService->delete($user);
    }

    public function testGetAllUsers(): void
    {
        $dto = $this->getDefaultUserDto();
        $this->userService->save($dto, false);
        $dto->email = 'test2@example.com';
        $dto->phone = '278934654344';
        $this->userService->save($dto, false);

        /** Вывод всех пользователей */
        $users = $this->userService->getAll();
        self::assertCount(2, $users);
    }

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $this->entityManager = $container->get(EntityManagerInterface::class);
        $this->passwordHasher = $container->get(UserPasswordHasherInterface::class);
        $this->userService = $container->get(UserService::class);
        $this->statementService = $container->get(StatementService::class);

        $this->entityManager->createQueryBuilder()->delete(Statement::class, 's')->getQuery()->execute();
        $this->entityManager->createQueryBuilder()->delete(User::class, 'u')->getQuery()->execute();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
    }

    private function getDefaultUserDto(): UserDto
    {
        return new UserDto(
            null,
            'test',
            '2003-08-11',
            'address',
            '89207777777',
            'test@example.com',
            [Role::User->value],
            'P@ssw0rd1234'
        );
    }

    private function compareUser(UserDto $dto, ?User $user): void
    {
        self::assertNotNull($user);
        self::assertSame($dto->name, $user->getName());
        self::assertEquals($dto->birthday, $user->getBirthday()->format('Y-m-d'));
        self::assertSame($dto->address, $user->getAddress());
        self::assertSame($dto->phone, $user->getPhone());
        self::assertSame($dto->email, $user->getEmail());
        self::assertEmpty(array_diff($dto->roles, $user->getRoles()));
        self::assertTrue($this->passwordHasher->isPasswordValid($user, $dto->password));
    }
}
