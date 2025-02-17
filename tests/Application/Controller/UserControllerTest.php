<?php

namespace App\Tests\Application\Controller;


use App\Dto\UserDto;
use App\Entity\Statement;
use App\Entity\User;
use App\Service\UserService;
use App\Thesaurus\Role;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $entityManager;
    private UserService $userService;

    public function testCreateUser(): void
    {
        $jsonData = json_encode($this->getDefaultUserDto());

        /** Регистрация пользователя */
        $this->client->request('POST', '/register', [], [], ['CONTENT_TYPE' => 'application/json'], $jsonData);
        $this->assertResponseIsSuccessful();

        /** Регистрация существующего пользователя */
        $this->client->request('POST', '/register', [], [], ['CONTENT_TYPE' => 'application/json'], $jsonData);
        $this->assertResponseStatusCodeSame(500, '{"error": "User with such mail or phone already exists"}');
    }

    public function testLogin(): void
    {
        $userDto = $this->getDefaultUserDto();
        $this->userService->save($userDto, false);

        $jsonData = json_encode([
            "username" => $userDto->email,
            "password" => $userDto->password
        ]);
        $this->client->request('POST', '/login_check', [], [], ['CONTENT_TYPE' => 'application/json'], $jsonData);
        $this->assertResponseIsSuccessful();
        $responseBody = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertNotEmpty($responseBody['token']);
    }

    public function testUpdateUser(): void
    {
        $userDto = $this->getDefaultUserDto();
        $this->userService->save($userDto, false);
        $tokenUser = $this->getJWT($userDto);

        $adminDto = $this->getDefaultUserDto();
        $adminDto->roles[] = Role::Admin->value;
        $this->userService->save($adminDto, true);
        $tokenAdmin = $this->getJWT($adminDto);

        /** Изменение пользователя */
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $userDto->email]);
        $userDto->id = $user->getId();
        $userDto->name = 'test2';
        $jsonData = json_encode($userDto);
        $this->client->request('PUT', '/user', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenUser"], $jsonData);
        $this->assertResponseIsSuccessful();

        /** Изменение другого пользователя без прав администратора */
        $userDto->id--;
        $jsonData = json_encode($userDto);
        try {
            $this->client->request('PUT', '/user', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenUser"], $jsonData);
        } catch (AccessDeniedHttpException $exception) {
            $this->assertSame(403, $exception->getStatusCode());
            $ok = true;
        }
        $ok ?? $this->fail('Failed to test user update without admin role.');

        /** Изменение другого пользователя от прав администратора */
        $userDto->id = $user->getId();
        $jsonData = json_encode($userDto);
        $this->client->request('PUT', '/user', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenAdmin"], $jsonData);
        $this->assertResponseIsSuccessful();
    }

    public function testDeleteUser(): void
    {
        $adminDto = $this->getDefaultUserDto();
        $adminDto->roles[] = Role::Admin->value;
        $this->userService->save($adminDto, true);
        $tokenAdmin = $this->getJWT($adminDto);

        $userDto = $this->getDefaultUserDto();
        $this->userService->save($userDto, false);
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $userDto->email]);
        $tokenUser = $this->getJWT($userDto);


        /** Удаление без роли администратора */
        try {
            $this->client->request('DELETE', '/user/' . $user->getId(), [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenUser"]);
        } catch (AccessDeniedException) {
            $ok = true;
        }
        $ok ?? $this->fail('Failed to test user delete without admin role.');

        /** Удаление пользователья администратором */
        $this->client->request('DELETE', '/user/' . $user->getId(), [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenAdmin"]);
        $this->assertResponseIsSuccessful();
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $userDto->email]);
        $this->assertNull($user);
    }

    public function testGetUser(): void
    {
        $adminDto = $this->getDefaultUserDto();
        $adminDto->roles[] = Role::Admin->value;
        $this->userService->save($adminDto, true);
        $admin = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $adminDto->email]);
        $tokenAdmin = $this->getJWT($adminDto);

        $userDto = $this->getDefaultUserDto();
        $this->userService->save($userDto, false);
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $userDto->email]);
        $tokenUser = $this->getJWT($userDto);

        /** Получение информации о пользователе самим пользователем */
        $this->client->request('GET', '/user/' . $user->getId(), [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenUser"]);
        $this->assertResponseIsSuccessful();
        $responseBody = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertNotEmpty($responseBody);

        /** Получение информации о пользователе администратором*/
        $this->client->request('GET', '/user/' . $user->getId(), [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenAdmin"]);
        $this->assertResponseIsSuccessful();
        $responseBody = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertNotEmpty($responseBody);

        /** Получение информации о пользователе другим пользователем */
        try {
            $this->client->request('GET', '/user/' . $admin->getId(), [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenUser"]);
        } catch (AccessDeniedHttpException) {
            $ok = true;
        }
        $ok ?? $this->fail('Failed to test get user without admin role.');
    }

    public function testGetAllUsers(): void
    {
        $adminDto = $this->getDefaultUserDto();
        $adminDto->roles[] = Role::Admin->value;
        $this->userService->save($adminDto, true);
        $tokenAdmin = $this->getJWT($adminDto);

        $userDto = $this->getDefaultUserDto();
        $this->userService->save($userDto, false);
        $tokenUser = $this->getJWT($userDto);

        /** Получение пользователей без роли администратора */
        try {
            $this->client->request('GET', '/user', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenUser"]);
        } catch (AccessDeniedException) {
            $ok = true;
        }
        $ok ?? $this->fail('Failed to test getting users without admin role.');

        /** Получение пользователей администратором */
        $this->client->request('GET', '/user', [], [], ['CONTENT_TYPE' => 'application/json', 'HTTP_AUTHORIZATION' => "Bearer $tokenAdmin"]);
        $this->assertResponseIsSuccessful();

        $responseBody = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertNotEmpty($responseBody);
    }

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $container = static::getContainer();

        $this->entityManager = $container->get(EntityManagerInterface::class);
        $this->userService = $container->get(UserService::class);

        $this->entityManager->createQueryBuilder()->delete(Statement::class, 's')->getQuery()->execute();
        $this->entityManager->createQueryBuilder()->delete(User::class, 'u')->getQuery()->execute();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
    }

    private function getJWT(UserDto $userDto): string
    {
        $jsonData = json_encode([
            "username" => $userDto->email,
            "password" => $userDto->password
        ]);
        $this->client->request('POST', '/login_check', [], [], ['CONTENT_TYPE' => 'application/json'], $jsonData);

        $responseBody = json_decode($this->client->getResponse()->getContent(), true);
        return $responseBody['token'];
    }

    private function getDefaultUserDto(): UserDto
    {
        static $id = 0;
        $id++;
        return new UserDto(
            null,
            sprintf('test%d', $id),
            '2003-08-11',
            'address',
            sprintf('8923777777%d', $id),
            sprintf('email%d@example.ru', $id),
            [Role::User->value],
            'P@ssw0rd1234'
        );
    }
}
