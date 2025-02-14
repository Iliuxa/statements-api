<?php

namespace App\Thesaurus;

enum Role: string
{
    case Admin = 'ROLE_ADMIN';

    case User = 'ROLE_USER';
}
