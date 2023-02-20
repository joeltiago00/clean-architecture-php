<?php

namespace App\Validators\User;

use App\Exceptions\Validation\User\EmailAlreadyInUseException;
use App\Exceptions\Validation\User\InvalidEmailException;
use App\Exceptions\Validation\User\InvalidLastNameException;
use App\Exceptions\Validation\User\InvalidNameException;
use App\Exceptions\Validation\ValidationException;
use App\Repositories\UserRepository;

class UserStoreValidator
{
    //this is a temporary solution
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    /**
     * @throws ValidationException
     */
    public function validate(array $payload): void
    {
        if (empty($payload['first_name']) || !is_string($payload['first_name']))
            throw new InvalidNameException();

        if (!empty($payload['last_name']) && !is_string($payload['last_name']))
            throw new InvalidLastNameException();

        if (!filter_var($payload['email'], FILTER_VALIDATE_EMAIL))
            throw new InvalidEmailException();

        $user = $this->userRepository->getByEmail($payload['email']);

        if (!empty($user))
            throw new EmailAlreadyInUseException();
    }
}