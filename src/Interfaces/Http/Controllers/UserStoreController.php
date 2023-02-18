<?php

namespace Interfaces\Http\Controllers;

use App\Actions\User\UserStore;
use App\Exceptions\Validation\ValidationException;
use App\Validators\User\UserStoreValidator;

class UserStoreController
{
    public function __construct(
        public readonly UserStore          $userStore,
        public readonly UserStoreValidator $userStoreValidator
    )
    {
    }

    public function __invoke(array $data): void
    {
        try {
            $this->userStoreValidator->validate($data);

            $user = $this->userStore->handle($data);
        } catch (ValidationException $exception) {
            returnExceptionJson($exception);
        }

        returnResponseJson($user, 201);
    }
}