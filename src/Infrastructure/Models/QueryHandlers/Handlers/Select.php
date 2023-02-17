<?php

namespace Infrastructure\Models\QueryHandlers\Handlers;

use Infrastructure\Models\Enums\TypeQueryEnum;
use Infrastructure\Models\QueryHandlers\Query;
use Infrastructure\Models\Replacers\QueryReplacer;

class Select extends Query
{
    public function __construct()
    {
        $this->queryEnum = TypeQueryEnum::SELECT;
        $this->replacer = new QueryReplacer();
    }
}