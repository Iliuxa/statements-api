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
        for ($i = 0; $i < 20; $i++) {
            $user = $this->createUser([Role::User->value]);
            $manager->persist($user);
        }

        for ($i = 0; $i < 3; $i++) {
            $user = $this->createUser([Role::User->value, Role::Admin->value]);
            $manager->persist($user);
        }

        $manager->flush();
    }

    /**
     * @param string[] $roles
     * @return User
     */
    private function createUser(array $roles): User
    {
        static $id = 0;
        $id++;
        $user = new User();
        return $user
            ->setName(sprintf('Пользователь %d', $id))
            ->setAddress(sprintf('Адрес %d', $id))
            ->setEmail(sprintf('email%d@yandex.ru', $id))
            ->setPhone(sprintf('8920777777%d', $id))
            ->setBirthday(DateTime::createFromFormat('Y-m-d', sprintf('2003-08-%d', $id)))
            ->setRoles($roles)
            ->setPassword($this->hasher->hashPassword($user, sprintf('P@ssw0rd1234%d', $id)))
            ->setInsertDate(new DateTime());
    }
}