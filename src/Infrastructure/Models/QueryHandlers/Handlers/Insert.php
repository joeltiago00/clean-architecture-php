<?php

namespace Infrastructure\Models\QueryHandlers\Handlers;

use Infrastructure\Models\Enums\TypeQueryEnum;
use Infrastructure\Models\QueryHandlers\QueryHandler;
use Infrastructure\Models\Replacers\QueryReplacer;

class Insert extends Handler
{
    public function __construct()
    {
        $this->queryEnum = TypeQueryEnum::INSERT;
        $this->replacer = new QueryReplacer();
    }
}