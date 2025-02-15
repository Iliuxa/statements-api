<?php

namespace App\Tests\Integration\Service;

use App\Dto\StatementDto;
use App\Entity\Statement;
use App\Entity\User;
use App\Service\StatementService;
use App\Thesaurus\Role;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class StatementServiceTest extends KernelTestCase
{
    private EntityManagerInterface $entityManager;
    private StatementService $statementService;

    public function testSaveStatement(): void
    {
        $user = $this->createUser();

        /** Создание заявления */
        $statementDto = $this->getDefaultStatementDto($user->getId());
        $this->statementService->save($statementDto);
        $this->entityManager->refresh($user);
        $statement = $user->getStatements()->current();
        $this->compareStatement($statementDto, $statement);

        /** Изменение заявления */
        $statementDto->id = $statement->getId();
        $statementDto->name = 'test2';
        $statementDto->description = 'test2 test2';
        $this->statementService->save($statementDto);
        $statement = $user->getStatements()->current();
        $this->compareStatement($statementDto, $statement);
    }

    public function testDeleteStatement(): void
    {
        /** Удаление  */
        $user = $this->createUser();
        $statementDto = $this->getDefaultStatementDto($user->getId());
        $this->statementService->save($statementDto);
        $this->entityManager->refresh($user);
        $statement = $user->getStatements()->current();
        self::assertNotEmpty($statement);

        $this->statementService->delete($statement);
        $this->entityManager->refresh($user);
        $statement = $user->getStatements()->current();
        self::assertEmpty($statement);
    }

    public function testGetAllStatements(): void
    {
        $user = $this->createUser();
        $statementDto = $this->getDefaultStatementDto($user->getId());
        $this->statementService->save($statementDto);
        $statementDto->name = 'test2';
        $this->statementService->save($statementDto);

        $user2 = $this->createUser();
        $statementDto = $this->getDefaultStatementDto($user2->getId());
        $this->statementService->save($statementDto);

        /** Вывод всех заявлений */
        $statements = $this->statementService->getAll();
        self::assertCount(3, $statements);
    }

    public function testGetByUserStatements(): void
    {
        $user = $this->createUser();
        $statementDto = $this->getDefaultStatementDto($user->getId());
        $this->statementService->save($statementDto);
        $statementDto->name = 'test2';
        $this->statementService->save($statementDto);

        $user2 = $this->createUser();
        $statementDto = $this->getDefaultStatementDto($user2->getId());
        $this->statementService->save($statementDto);

        /** Вывод всех заявлений конкретного пользователя */
        $statements = $this->statementService->getByUser($user);
        self::assertCount(2, $statements);
    }

    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $this->entityManager = $container->get(EntityManagerInterface::class);
        $this->statementService = $container->get(StatementService::class);

        $this->entityManager->createQueryBuilder()->delete(Statement::class, 's')->getQuery()->execute();
        $this->entityManager->createQueryBuilder()->delete(User::class, 'u')->getQuery()->execute();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
    }

    private function getDefaultStatementDto(int $ownerId): StatementDto
    {
        return new StatementDto(
            null,
            'testName',
            '2025-AA',
            'test test test test test',
            $ownerId
        );
    }

    private function createUser(): User
    {
        static $id = 0;
        $id++;
        $user = (new User())
            ->setName(sprintf('test%d', $id))
            ->setAddress(sprintf('address%d', $id))
            ->setEmail(sprintf('test%d@example.com', $id))
            ->setPhone(sprintf('8920777777%d', $id))
            ->setBirthday(DateTime::createFromFormat('Y-m-d', sprintf('2003-08-%d', $id)))
            ->setRoles([Role::User->value])
            ->setPassword(sprintf('pass%d', $id))
            ->setInsertDate(new DateTime());
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;
    }

    private function compareStatement(StatementDto $dto, ?Statement $statement): void
    {
        self::assertNotNull($statement);
        self::assertSame($dto->name, $statement->getName());
        self::assertSame($dto->number, $statement->getNumber());
        self::assertSame($dto->description, $statement->getDescription());
    }
}