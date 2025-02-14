<?php

namespace App\Service;

use App\Dto\StatementDto;
use App\Entity\Statement;
use App\Entity\User;
use App\Repository\StatementRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;

class StatementService
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly StatementRepository    $statementRepository,
        private readonly LoggerInterface        $logger,
    )
    {
    }

    public function save(StatementDto $statementDto): void
    {
        try {
            $statement = empty($statementDto->id) ? new Statement() : $this->statementRepository->find($statementDto->id);
            $statement
                ->setName($statementDto->name)
                ->setNumber($statementDto->number)
                ->setDescription($statementDto->description)
                ->setInsertDate(new DateTime())
                ->setOwner($this->em->getReference(User::class, $statementDto->ownerId));

            $this->em->persist($statement);
            $this->em->flush();
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw new Exception('Error saving statement.');
        }
    }

    public function delete(Statement $statement): void
    {
        try {
            $this->em->remove($statement);
            $this->em->flush();
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw new Exception('Error deleting statement.');
        }
    }

    public function getAll(): array
    {
        try {
            return $this->statementRepository->findAll();
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw new Exception('Error getting statements.');
        }
    }

    public function getByUser(User $user)
    {
        try {
            return $this->statementRepository->findBy(['owner' => $user]);
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw new Exception('Error getting statement.');
        }
    }
}