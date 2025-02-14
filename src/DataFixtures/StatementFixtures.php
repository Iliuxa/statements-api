<?php

namespace App\DataFixtures;

use App\Entity\Statement;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class StatementFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $users = $manager->getRepository(User::class)->findAll();

        foreach ($users as $user) {
            $count = rand(1, 4);
            for ($i = 1; $i < $count; $i++) {
                $statement = (new Statement())
                    ->setName(sprintf('Заявление %d', $i))
                    ->setNumber(sprintf('ЗА-1-%d', $i))
                    ->setDescription(sprintf('Текст заявлениея %d', $i))
                    ->setInsertDate(new DateTime())
                    ->setOwner($user);

                $manager->persist($statement);
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}