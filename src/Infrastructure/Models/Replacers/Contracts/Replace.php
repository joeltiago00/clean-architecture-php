<?php

namespace Infrastructure\Models\Replacers\Contracts;

interface Replace
{
    public function handle(mixed $content);
}