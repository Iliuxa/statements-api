<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PasswordStrength;

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

//        #[NotBlank]
//        public int    $roleId,

        #[NotBlank]
        #[PasswordStrength(minScore: 1)]
        public string $password,
    )
    {
    }
}