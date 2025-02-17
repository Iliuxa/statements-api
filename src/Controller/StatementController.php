<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\StatementDto;
use App\Entity\Statement;
use App\Entity\User;
use App\Service\StatementService;
use App\Thesaurus\Role;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class StatementController extends AbstractController
{
    public function __construct(
        private readonly StatementService $service
    )
    {
    }

    #[Route('/statement', name: 'save_statement', methods: ['POST', 'PUT'], format: 'JSON')]
    public function save(#[MapRequestPayload] StatementDto $statementDto): Response
    {
        if (!$this->isGranted(Role::Admin->value) && $statementDto->ownerId !== $this->getUser()->getId()) {
            throw new AccessDeniedHttpException();
        }
        $this->service->save($statementDto);
        return new Response();
    }

    #[Route('/statement/{id}', name: 'delete_statement', methods: ['DELETE'], format: 'JSON')]
    public function delete(Statement $statement): Response
    {
        if (!$this->isGranted(Role::Admin->value) && $statement->getOwner()->getId() !== $this->getUser()->getId()) {
            throw new AccessDeniedHttpException();
        }
        $this->service->delete($statement);
        return new Response();
    }

    #[Route('/statement/{id}', name: 'get_statement', methods: ['GET'], format: 'JSON')]
    public function get(Statement $statement): JsonResponse
    {
        if (!$this->isGranted(Role::Admin->value) && $statement->getOwner()->getId() !== $this->getUser()->getId()) {
            throw new AccessDeniedHttpException();
        }
        return $this->json($statement);
    }

    #[Route('/statement', name: 'get_all_statements', methods: ['GET'], format: 'JSON')]
    public function getAll(#[CurrentUser] User $user): JsonResponse
    {
        if ($this->isGranted(Role::Admin->value)) {
            $statements = $this->service->getAll();
        } else {
            $statements = $this->service->getByUser($user);
        }

        return $this->json($statements);
    }
}
