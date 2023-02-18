<?php

namespace Drivers\Database\SQLite\Replacers\Replaces;

use Drivers\Database\SQLite\Contracts\Replace;
use function Infrastructure\Models\Replacers\Replaces\str_contains;

class ReplaceValues implements Replace
{

    public function handle(mixed $content)
    {
        if (str_contains($content['query'], '{values}')) {
            $content['query'] = str_replace('{values}', $content['values'], $content['query']);
        }

        return $content;
    }
}