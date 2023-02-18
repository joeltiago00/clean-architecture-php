<?php

namespace Drivers\Database\SQLite\Replacers\Contracts;

interface Replace
{
    public function handle(mixed $content);
}