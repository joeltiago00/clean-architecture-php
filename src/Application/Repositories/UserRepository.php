<?php

namespace App\Repositories;


use App\Models\User;

interface UserRepository
{
    public function create(array $data): array;

    public function find(int $id): array;
}