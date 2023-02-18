<?php

namespace Drivers\Database\SQLite\QueryHandlers;

class QueryDTO
{
    public function __construct(
        public readonly string $text,
        public readonly array  $data
    )
    {
    }
}