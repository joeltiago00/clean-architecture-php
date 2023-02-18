<?php

namespace App\Actions\User;

use App\Repositories\UserRepository;
use Domain\User\User;

class UserStore
{
    public function __construct(public readonly UserRepository $userRepository)
    {
    }

    public function handle(array $data): array
    {
        $user = new User($data['first_name'], $data['last_name'] ?? null, $data['email']);

        return $this->userRepository->create($user);
    }
}