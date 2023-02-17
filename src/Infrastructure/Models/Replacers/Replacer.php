<?php

namespace Infrastructure\Models\Replacers;

use Infrastructure\Chain\Chain;

abstract class Replacer
{
    protected Chain $replacer;

    public function __construct()
    {
        $this->replacer = new Chain();
    }
}