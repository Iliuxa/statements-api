<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PasswordStrength;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "UserDto",
    required: ["name", "birthday", "address", "phone", "email", "roles", "password"],
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1, nullable: true),
        new OA\Property(property: "name", type: "string", example: "Иван Иванов"),
        new OA\Property(property: "birthday", type: "string", format: "date", example: "1990-01-01"),
        new OA\Property(property: "address", type: "string", example: "г. Москва, ул. Пушкина, д. 10"),
        new OA\Property(property: "phone", type: "string", maxLength: 15, example: "89991234567"),
        new OA\Property(property: "email", type: "string", format: "email", example: "ivan@example.com"),
        new OA\Property(
            property: "roles",
            type: "array",
            items: new OA\Items(type: "string"),
            example: ["ROLE_USER", "ROLE_ADMIN"]
        ),
        new OA\Property(property: "password", type: "string", format: "password", example: "SecurePass123!")
    ]
)]
class UserDto
{
    public function __construct(
        public ?int   $id,

        #[NotBlank]
        public string $name,

        #[NotBlank]
        #[Date]
        public string $birthday,

        #[NotBlank]
        public string $address,

        #[NotBlank]
        #[Length(max: 15)]
        public string $phone,

        #[NotBlank]
        #[Email]
        public string $email,

        /**
         * @var string[]
         */
        public array  $roles,

        #[NotBlank]
        #[PasswordStrength(minScore: 1)]
        public string $password,
    )
    {
    }
}