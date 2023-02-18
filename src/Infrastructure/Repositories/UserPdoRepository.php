<?php

namespace Infrastructure\Repositories;

use App\Models\User;
use App\Repositories\UserRepository;

class UserPdoRepository implements UserRepository
{
    private User $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function create(array $data): array
    {
        return $this->model->create($data);
    }

    public function find(int $id): array
    {
        return $this->model->find($id);
    }
}