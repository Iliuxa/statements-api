<?php

namespace App\Dto;

use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints\NotBlank;


#[OA\Schema(
    schema: "StatementDto",
    required: ["name"],
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1, nullable: true),
        new OA\Property(property: "name", type: "string", example: "Заявление на отпуск"),
        new OA\Property(property: "number", type: "string", example: "12345-ABC", nullable: true),
        new OA\Property(property: "description", type: "string", example: "Заявление на отпуск на 180 дней", nullable: true),
        new OA\Property(property: "ownerId", type: "integer", example: 42, nullable: true),
        new OA\Property(property: "file", ref: "#/components/schemas/FileDto", description: "Файл, прикрепленный к заявлению", nullable: true)
    ]
)]
class StatementDto
{
    public function __construct(
        public ?int     $id,

        #[NotBlank]
        public string   $name,

        public ?string  $number,

        public ?string  $description,

        public ?int     $ownerId,

        public ?FileDto $file
    )
    {
    }
}