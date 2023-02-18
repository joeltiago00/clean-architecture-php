<?php

namespace Infrastructure\Models\QueryHandlers\Handlers;

use Infrastructure\Models\Enums\TypeQueryEnum;
use Infrastructure\Models\Replacers\Replacer;

abstract class Handler
{
    public TypeQueryEnum $queryEnum;
    public Replacer $replacer;
}