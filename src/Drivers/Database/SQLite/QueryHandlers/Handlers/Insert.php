<?php

namespace Drivers\Database\SQLite\QueryHandlers\Handlers;

use Drivers\Database\SQLite\Enums\TypeQueryEnum;
use Drivers\Database\SQLite\Replacers\QueryReplacer;

class Insert extends Handler
{
    public function __construct()
    {
        $this->queryEnum = TypeQueryEnum::INSERT;
        $this->replacer = new QueryReplacer();
    }
}