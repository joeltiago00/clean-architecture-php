<?php

namespace Infrastructure\Models\Replacers\Replaces;

use Infrastructure\Models\Replacers\Contracts\Replace;

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