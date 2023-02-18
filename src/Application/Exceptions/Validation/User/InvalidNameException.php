<?php

namespace App\Exceptions\Validation\User;

use App\Exceptions\Validation\ValidationException;

class InvalidNameException extends ValidationException
{
    public function __construct()
    {
        parent::__construct(
            'Invalid name.',
            422
        );
    }
}