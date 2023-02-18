<?php

namespace Drivers\Database\SQLite\Replacers\Replaces;

use Drivers\Database\SQLite\Contracts\Replace;

class ReplaceColumns implements Replace
{

    public function handle(mixed $content)
    {
        if (str_contains($content['query'], '{columns}')) {
            $content['query'] = str_replace('{columns}', $content['columns'], $content['query']);
        }

        return $content;
    }
}