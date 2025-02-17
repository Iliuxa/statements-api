<?php

namespace App\Entity;

use App\Repository\StatementRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Statement",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "name", type: "string", example: "Заявление на отпуск"),
        new OA\Property(property: "number", type: "string", example: "12345-ABC", nullable: true),
        new OA\Property(property: "insertDate", type: "string", format: "date-time", example: "2024-02-18T12:00:00Z"),
        new OA\Property(property: "fileId", type: "integer", example: 42, nullable: true),
        new OA\Property(property: "description", type: "string", maxLength: 2000, example: "Заявление на отпуск на 14 дней", nullable: true),
        new OA\Property(
            property: "owner",
            ref: "#/components/schemas/User"
        )
    ]
)]
#[Entity(repositoryClass: StatementRepository::class)]
class Statement
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[Column(type: Types::STRING, length: 255)]
    private ?string $name = null;

    #[Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $number = null;

    #[Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTime $insertDate = null;

    #[Column(type: Types::INTEGER, nullable: true)]
    private ?int $fileId = null;

    #[Column(type: Types::STRING, length: 2000, nullable: true)]
    private ?string $description = null;

    #[JoinColumn]
    #[ManyToOne(targetEntity: User::class)]
    private User $owner;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Statement
    {
        $this->name = $name;
        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): Statement
    {
        $this->number = $number;
        return $this;
    }

    public function getInsertDate(): ?DateTime
    {
        return $this->insertDate;
    }

    public function setInsertDate(?DateTime $insertDate): Statement
    {
        $this->insertDate = $insertDate;
        return $this;
    }

    public function getFileId(): ?int
    {
        return $this->fileId;
    }

    public function setFileId(?int $fileId): Statement
    {
        $this->fileId = $fileId;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Statement
    {
        $this->description = $description;
        return $this;
    }

    public function getOwner(): User
    {
        return $this->owner;
    }

    public function setOwner(User $owner): Statement
    {
        $this->owner = $owner;
        return $this;
    }
}
