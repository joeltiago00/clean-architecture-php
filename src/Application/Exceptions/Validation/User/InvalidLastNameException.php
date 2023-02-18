<?php

namespace App\Exceptions\Validation\User;

use App\Exceptions\Validation\ValidationException;

class InvalidLastNameException extends ValidationException
{
    public function __construct()
    {
        parent::__construct(
            'Invalid last name.',
            422
        );
    }
}