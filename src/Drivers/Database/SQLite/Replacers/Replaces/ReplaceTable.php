<?php

namespace Drivers\Database\SQLite\Replacers\Replaces;

use Drivers\Database\SQLite\Contracts\Replace;

class ReplaceTable implements Replace
{

    public function handle(mixed $content)
    {
        if (str_contains($content['query'], '{table}')) {
            $content['query'] = str_replace('{table}', $content['table'], $content['query']);
        }

        return $content;
    }
}