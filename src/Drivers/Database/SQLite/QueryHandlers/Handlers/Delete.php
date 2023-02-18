<?php

namespace Drivers\Database\SQLite\QueryHandlers\Handlers;

use Drivers\Database\SQLite\Enums\TypeQueryEnum;
use Drivers\Database\SQLite\Replacers\QueryReplacer;

class Delete extends Handler
{
    public function __construct()
    {
        $this->queryEnum = TypeQueryEnum::DELETE;
        $this->replacer = new QueryReplacer();
    }
}