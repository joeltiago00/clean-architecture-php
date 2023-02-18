<?php

namespace App\Repositories;


interface UserRepository
{
    public function create(array $data): array;

    public function find(int $id): array;
}