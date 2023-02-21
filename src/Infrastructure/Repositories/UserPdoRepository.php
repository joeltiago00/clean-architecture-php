<?php

namespace Infrastructure\Repositories;

use App\Models\User;
use App\Repositories\UserRepository;

class UserPdoRepository implements UserRepository
{
    public function __construct(private readonly User $model)
    {
    }

    public function create(\Domain\User\User $user): array
    {
        return $this->model
            ->create([
                'first_name' => $user->firstName,
                'last_name' => $user->lastName,
                'email' => $user->email
            ]);
    }

    public function find(int $id): array
    {
        return $this->model
            ->find($id);
    }

    public function getByEmail(string $email): array
    {
        return $this->model
            ->where('email', '=', $email)
            ->get();
    }
}