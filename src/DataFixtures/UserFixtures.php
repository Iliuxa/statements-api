<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Thesaurus\Role;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 21; $i++) {
            $user = $this->createUser([Role::User->value], $i);
            $manager->persist($user);
        }

        for ($i = 21; $i < 24; $i++) {
            $user = $this->createUser([Role::User->value, Role::Admin->value], $i);
            $manager->persist($user);
        }

        $manager->flush();
    }

    private function createUser(array $roles, int $i): User
    {
        $user = new User();
        return $user
            ->setName(sprintf('Пользователь %d', $i))
            ->setAddress(sprintf('Адрес %d', $i))
            ->setEmail(sprintf('email%d@yandex.ru', $i))
            ->setPhone(sprintf('8920777777%d', $i))
            ->setBirthday(DateTime::createFromFormat('Y-m-d', sprintf('2003-08-%d', $i)))
            ->setRoles($roles)
            ->setPassword($this->hasher->hashPassword($user, sprintf('P@ssw0rd1234%d', $i)))
            ->setInsertDate(new DateTime());
    }
}