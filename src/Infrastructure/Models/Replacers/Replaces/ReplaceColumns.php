<?php

namespace Infrastructure\Models\Replacers\Replaces;

use Infrastructure\Models\Replacers\Contracts\Replace;

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