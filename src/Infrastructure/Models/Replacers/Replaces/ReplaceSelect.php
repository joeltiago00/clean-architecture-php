<?php

namespace Infrastructure\Models\Replacers\Replaces;

use Infrastructure\Models\Replacers\Contracts\Replace;

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