<?php

namespace App\Repositories;


use Domain\User\User;

interface UserRepository
{
    public function create(User $user): array;

    public function find(int $id): array;

    public function getByEmail(string $email): array;
}