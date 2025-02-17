<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function getAnotherUsersByEmailOrPhone(?int $id, string $email, string $phone): array
    {
        $queryBuilder = $this->createQueryBuilder('user')
            ->setParameter('email', $email)
            ->setParameter('phone', $phone);

        $queryBuilder->where($queryBuilder->expr()->orX(
            $queryBuilder->expr()->like('user.phone', ':phone'),
            $queryBuilder->expr()->like('user.email', ':email')
        ));

        if ($id !== null) {
            $queryBuilder->andWhere($queryBuilder->expr()->neq('user.id', ':id'))
                ->setParameter('id', $id);
        }

        return $queryBuilder->getQuery()->getResult();
    }
}
