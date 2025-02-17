<?php

namespace App\Tests\Application\Controller;

use App\Dto\StatementDto;
use App\Dto\UserDto;
use App\Entity\Statement;
use App\Entity\User;
use App\Service\StatementService;
use App\Service\UserService;
use App\Thesaurus\Role;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class StatementControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $entityManager;
    private UserService $userService;
    private StatementService $statementService;

    public function testSaveStatement(): void
    {
        [$user, $tokenUser] = $this->createUser(false);
        [$admin, $tokenAdmin] = $this->createUser(true);

        $jsonData = json_encode($this->getDefaultStatementDto($user->getId()));

        /** Создание заявление пользователем */
        $this->client->request('POST', '/statement', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenUser"], $jsonData);
        $this->assertResponseIsSuccessful();

        /** Создание заявление администратором */
        $jsonData = json_encode($this->getDefaultStatementDto($admin->getId()));
        $this->client->request('POST', '/statement', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenAdmin"], $jsonData);
        $this->assertResponseIsSuccessful();

        /** Изменение заявления пользователем */
        $user = $this->entityManager->find(User::class, $user->getId());
        $statementDto = $this->getDefaultStatementDto($user->getId());
        $statementDto->id = $user->getStatements()->current()->getId();
        $statementDto->name = 'test2';
        $jsonData = json_encode($statementDto);
        $this->client->request('PUT', '/statement', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenUser"], $jsonData);
        $this->assertResponseIsSuccessful();

        /** Изменение заявления администратором */
        $statementDto->name = 'test3';
        $jsonData = json_encode($statementDto);
        $this->client->request('PUT', '/statement', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenAdmin"], $jsonData);
        $this->assertResponseIsSuccessful();

        /** Изменение пользователем чужого заявления */
        $admin = $this->entityManager->find(User::class, $admin->getId());
        $statementDto = $this->getDefaultStatementDto($admin->getId());
        $statementDto->id = $admin->getStatements()->current()->getId();
        $statementDto->name = 'test4';
        $jsonData = json_encode($statementDto);
        try {
            $this->client->request('PUT', '/statement', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenUser"], $jsonData);
        } catch (AccessDeniedHttpException) {
            $ok = true;
        }
        $ok ?? $this->fail('Failed to test statement update without admin role.');
    }

    public function testDeleteStatement(): void
    {
        [$user, $tokenUser] = $this->createUser(false);
        [$admin, $tokenAdmin] = $this->createUser(true);

        /** Удаление заявления */
        $statementDto = $this->getDefaultStatementDto($user->getId());
        $this->statementService->save($statementDto);
        $statement = $this->entityManager->getRepository(Statement::class)->findOneBy(['owner' => $user]);
        $this->client->request('DELETE', '/statement/' . $statement->getId(), [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenUser"]);
        $this->assertResponseIsSuccessful();

        /** Удаление чужого зявления не администратором */
        $statementDto = $this->getDefaultStatementDto($admin->getId());
        $this->statementService->save($statementDto);
        $statement = $this->entityManager->getRepository(Statement::class)->findOneBy(['owner' => $admin]);
        try {
            $this->client->request('DELETE', '/statement/' . $statement->getId(), [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenUser"]);
        } catch (AccessDeniedHttpException) {
            $ok = true;
        }
        $ok ?? $this->fail('Failed to test statement delete without admin role.');

        /** Удаление чужого зявления администратором */
        $statementDto = $this->getDefaultStatementDto($user->getId());
        $this->statementService->save($statementDto);
        $statement = $this->entityManager->getRepository(Statement::class)->findOneBy(['owner' => $user]);
        $this->client->request('DELETE', '/statement/' . $statement->getId(), [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenAdmin"]);
        $this->assertResponseIsSuccessful();
    }

    public function testGetStatement(): void
    {
        [$user, $tokenUser] = $this->createUser(false);
        [$admin, $tokenAdmin] = $this->createUser(true);

        /** Получение заявления */
        $statementDto = $this->getDefaultStatementDto($user->getId());
        $this->statementService->save($statementDto);
        $statement = $this->entityManager->getRepository(Statement::class)->findOneBy(['owner' => $user]);
        $this->client->request('GET', '/statement/' . $statement->getId(), [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenUser"]);
        $this->assertResponseIsSuccessful();
        $responseBody = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertNotEmpty($responseBody);

        /** Получение чужого зявлния администратором */
        $this->client->request('GET', '/statement/' . $statement->getId(), [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenAdmin"]);
        $this->assertResponseIsSuccessful();
        $responseBody = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertNotEmpty($responseBody);

        /** Получение чужого зявлния не администратором */
        $statementDto = $this->getDefaultStatementDto($admin->getId());
        $this->statementService->save($statementDto);
        $statement = $this->entityManager->getRepository(Statement::class)->findOneBy(['owner' => $admin]);
        try {
            $this->client->request('DELETE', '/statement/' . $statement->getId(), [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenUser"]);
        } catch (AccessDeniedHttpException) {
            $ok = true;
        }
        $ok ?? $this->fail('Failed to test getting statement without admin role.');
    }

    public function testGetAllStatements(): void
    {
        [$user, $tokenUser] = $this->createUser(false);
        [$admin, $tokenAdmin] = $this->createUser(true);

        $statementDto = $this->getDefaultStatementDto($user->getId());
        $this->statementService->save($statementDto);
        $this->statementService->save($statementDto);
        $statementDto = $this->getDefaultStatementDto($admin->getId());
        $this->statementService->save($statementDto);

        /** Получение заявлений администратором */
        $this->client->request('GET', '/statement', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenAdmin"]);
        $responseBody = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertCount(3, $responseBody);

        /** Получение заявлений пользователем */
        $this->client->request('GET', '/statement', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenUser"]);
        $responseBody = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertCount(2, $responseBody);
    }

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $container = static::getContainer();

        $this->entityManager = $container->get(EntityManagerInterface::class);
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

    private function createUser(bool $isAdmin): array
    {
        static $id = 0;
        $id++;
        $email = sprintf('address%d', $id);
        $password = sprintf('P@ssw0ed1234%d', $id);
        $this->userService->save(new UserDto(
            null,
            sprintf('test%d', $id),
            sprintf('2003-08-%d', $id),
            sprintf('address%d', $id),
            sprintf('8920777777%d', $id),
            $email,
            $isAdmin ? [Role::User->value, Role::Admin->value] : [Role::User->value],
            $password
        ), $isAdmin);

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        $jsonData = json_encode([
            "username" => $email,
            "password" => $password
        ]);
        $this->client->request('POST', '/login_check', [], [], ['CONTENT_TYPE' => 'application/json'], $jsonData);
        $responseBody = json_decode($this->client->getResponse()->getContent(), true);

        return [$user, $responseBody['token']];
    }
}