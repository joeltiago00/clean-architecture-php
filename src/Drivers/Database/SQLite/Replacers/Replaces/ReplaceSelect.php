<?php

namespace Drivers\Database\SQLite\Replacers\Replaces;

use Drivers\Database\SQLite\Contracts\Replace;

class ReplaceSelect implements Replace
{

    public function handle(mixed $content)
    {
        if (str_contains($content['query'], '{select}')) {
            $content['query'] = str_replace('{select}', $content['select'], $content['query']);
        }

        return $content;
    }
}