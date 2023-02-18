<?php

namespace Drivers\Database\SQLite\QueryHandlers\Handlers;

use Drivers\Database\SQLite\Enums\TypeQueryEnum;
use Drivers\Database\SQLite\Replacers\Replacer;

abstract class Handler
{
    public TypeQueryEnum $queryEnum;
    public Replacer $replacer;
}