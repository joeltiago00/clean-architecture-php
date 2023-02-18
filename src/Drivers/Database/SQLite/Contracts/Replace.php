<?php

namespace Drivers\Database\SQLite\Contracts;

interface Replace
{
    public function handle(mixed $content);
}