<?php

namespace App\Exceptions\Validation\User;

use App\Exceptions\Validation\ValidationException;

class InvalidEmailException extends ValidationException
{
    public function __construct()
    {
        parent::__construct(
            'Invalid email.',
            422
        );
    }
}