<?php

namespace Infrastructure\Models\QueryHandlers\Contracts;

use Infrastructure\Models\QueryHandlers\Handlers\Handler;
use Infrastructure\Models\QueryHandlers\QueryDTO;

interface Query
{
    public function handle(Handler $handler, string $table, array $data, string $conditions = '', string $select = ''): QueryDTO;
}