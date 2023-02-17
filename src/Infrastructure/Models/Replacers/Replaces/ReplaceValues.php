<?php

namespace Infrastructure\Models\Replacers\Replaces;

use Infrastructure\Models\Replacers\Contracts\Replace;

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