<?php

namespace Infrastructure\Models\Replacers\Replaces;

use Infrastructure\Models\Replacers\Contracts\Replace;

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