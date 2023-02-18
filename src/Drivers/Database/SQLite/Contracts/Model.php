<?php

namespace Drivers\Database\SQLite\Contracts;

interface Model
{
    public function create(array $data): array;

    public function find(int $id): array;

    public function get(): array;

    public function update(array $data): bool;

    public function delete(): bool;
}