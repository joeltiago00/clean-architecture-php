<?php

namespace Drivers\Database\SQLite\QueryHandlers\Contracts;

use Drivers\Database\SQLite\QueryHandlers\Handlers\Handler;
use Drivers\Database\SQLite\QueryHandlers\QueryDTO;

interface Query
{
    public function handle(Handler $handler, string $table, array $data, string $conditions = '', string $select = ''): QueryDTO;
}