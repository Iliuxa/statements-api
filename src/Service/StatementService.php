<?php

namespace App\Service;

use App\Dto\StatementDto;
use App\Entity\Statement;
use App\Entity\User;
use App\Exception\ApiException;
use App\Repository\StatementRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
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

    /**
     * Создание и изменение заявления
     * @param StatementDto $statementDto
     * @return void
     * @throws ORMException
     */
    public function save(StatementDto $statementDto): void
    {
        try {
            $statement = $statementDto->id === null ? new Statement() : $this->statementRepository->find($statementDto->id);
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
            throw new ApiException('Error saving statement.');
        }
    }

    /**
     * Удаление заявления
     * @param Statement $statement
     * @return void
     */
    public function delete(Statement $statement): void
    {
        try {
            $this->em->remove($statement);
            $this->em->flush();
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw new ApiException('Error deleting statement.');
        }
    }

    /**
     * Получение всех заявлений
     * @return Statement[]
     */
    public function getAll(): array
    {
        try {
            return $this->statementRepository->findAll();
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw new ApiException('Error getting statements.');
        }
    }

    /**
     * Получение всех заявлений доступных пользователю
     * @param User $user
     * @return Statement[]
     */
    public function getByUser(User $user): array
    {
        try {
            return $user->getStatements()->toArray();
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            throw new ApiException('Error getting statement.');
        }
    }
}