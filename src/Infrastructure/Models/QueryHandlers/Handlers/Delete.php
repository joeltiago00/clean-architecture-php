<?php

namespace Infrastructure\Models\QueryHandlers\Handlers;

use Infrastructure\Models\Enums\TypeQueryEnum;
use Infrastructure\Models\QueryHandlers\Query;
use Infrastructure\Models\Replacers\QueryReplacer;

class Delete extends Query
{
    public function __construct()
    {
        $this->queryEnum = TypeQueryEnum::DELETE;
        $this->replacer = new QueryReplacer();
    }
}