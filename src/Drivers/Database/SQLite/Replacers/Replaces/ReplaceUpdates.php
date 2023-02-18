<?php

namespace Drivers\Database\SQLite\Replacers\Replaces;

use Drivers\Database\SQLite\Contracts\Replace;
use function Infrastructure\Models\Replacers\Replaces\str_contains;

class ReplaceUpdates implements Replace
{

    public function handle(mixed $content)
    {
        if (str_contains($content['query'], '{updates}')) {
            $content['query'] = str_replace('{updates}', $content['updates'], $content['query']);
        }

        return $content;
    }
}