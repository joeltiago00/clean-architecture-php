<?php

namespace App\Exceptions\Validation\User;

use App\Exceptions\Validation\ValidationException;

class EmailAlreadyInUseException extends ValidationException
{
    public function __construct()
    {
        parent::__construct(
            'Email is already in use.',
            422
        );
    }
}