<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints\NotBlank;

class StatementDto
{
    public function __construct(
        public ?int    $id,

        #[NotBlank]
        public string  $name,

        public ?string $number,

        public ?string $description,

        public ?int    $ownerId,
    )
    {
    }
}