<?php

namespace Infrastructure\Models\Replacers\Replaces;

use Infrastructure\Models\Replacers\Contracts\Replace;

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