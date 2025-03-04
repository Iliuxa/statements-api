<?php

namespace App\Entity;

use App\Repository\UserRepository;
use App\Thesaurus\Role;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Attribute\Ignore;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "User",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "name", type: "string", example: "Иван Иванов"),
        new OA\Property(property: "email", type: "string", format: "email", example: "ivan@example.com"),
        new OA\Property(property: "phone", type: "string", maxLength: 15, example: "89991234567"),
        new OA\Property(property: "birthday", type: "string", format: "date-time", example: "1990-01-01T00:00:00Z"),
        new OA\Property(property: "address", type: "string", example: "г. Москва, ул. Пушкина, д. 10"),
        new OA\Property(property: "insertDate", type: "string", format: "date-time", example: "2024-02-18T12:00:00Z"),
        new OA\Property(
            property: "roles",
            type: "array",
            items: new OA\Items(type: "string"),
            example: ["ROLE_USER", "ROLE_ADMIN"]
        )
    ]
)]
#[Entity(repositoryClass: UserRepository::class)]
#[Table(name: '`user`')]
#[UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[Column(type: Types::STRING, length: 255)]
    private ?string $name = null;

    #[Column(type: Types::STRING, length: 180, unique: true)]
    private ?string $email = null;

    #[Column(type: Types::STRING, length: 15, unique: true)]
    private ?string $phone = null;

    #[Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $birthday = null;

    #[Column(type: Types::STRING, length: 255)]
    private ?string $address = null;

    #[Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTime $insertDate = null;

    /**
     * @var list<string> The user roles
     */
    #[Column(type: Types::JSON)]
    private array $roles = [];

    #[Ignore]
    #[Column(type: Types::STRING)]
    private ?string $password = null;

    #[Ignore]
    #[OneToMany(targetEntity: Statement::class, mappedBy: 'owner')]
    private Collection $statements;

    public function __construct()
    {
        $this->statements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): User
    {
        $this->name = $name;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): User
    {
        $this->phone = $phone;
        return $this;
    }

    public function getBirthday(): ?DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?DateTimeInterface $birthday): User
    {
        $this->birthday = $birthday;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): User
    {
        $this->address = $address;
        return $this;
    }

    public function getInsertDate(): ?DateTime
    {
        return $this->insertDate;
    }

    public function setInsertDate(?DateTime $insertDate): User
    {
        $this->insertDate = $insertDate;
        return $this;
    }

    public function getStatements(): Collection
    {
        return $this->statements;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @return list<string>
     * @see UserInterface
     *
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = Role::User->value;

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
