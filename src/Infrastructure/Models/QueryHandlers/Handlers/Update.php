<?php

namespace Infrastructure\Models\QueryHandlers\Handlers;

use Infrastructure\Models\Enums\TypeQueryEnum;
use Infrastructure\Models\QueryHandlers\Query;
use Infrastructure\Models\Replacers\QueryReplacer;

class Update extends Query
{
    public function __construct()
    {
        $this->queryEnum = TypeQueryEnum::UPDATE;
        $this->replacer = new QueryReplacer();
    }
}