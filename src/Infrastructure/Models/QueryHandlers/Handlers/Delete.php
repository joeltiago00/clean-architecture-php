<?php

namespace Infrastructure\Models\QueryHandlers\Handlers;

use Infrastructure\Models\Enums\TypeQueryEnum;
use Infrastructure\Models\QueryHandlers\QueryHandler;
use Infrastructure\Models\Replacers\QueryReplacer;

class Delete extends Handler
{
    public function __construct()
    {
        $this->queryEnum = TypeQueryEnum::DELETE;
        $this->replacer = new QueryReplacer();
    }
}