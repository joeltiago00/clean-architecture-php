<?php

namespace Drivers\Database\SQLite\Replacers\Replaces;

use Drivers\Database\SQLite\Contracts\Replace;
use function Infrastructure\Models\Replacers\Replaces\str_contains;

class ReplaceConditions implements Replace
{

    public function handle(mixed $content)
    {
        if (str_contains($content['query'], '{conditions}')) {
            $content['query'] = str_replace('{conditions}', $content['conditions'], $content['query']);
        }

        return $content;
    }
}