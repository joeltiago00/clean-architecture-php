<?php

namespace Infrastructure\Models\Replacers;

use Infrastructure\Models\Replacers\Replaces\ReplaceColumns;
use Infrastructure\Models\Replacers\Replaces\ReplaceConditions;
use Infrastructure\Models\Replacers\Replaces\ReplaceSelect;
use Infrastructure\Models\Replacers\Replaces\ReplaceTable;
use Infrastructure\Models\Replacers\Replaces\ReplaceValues;

class QueryReplacer extends Replacer
{
    public function handle(array $content): string
    {
        $result = $this->replacer
            ->with($content)
            ->through([
                ReplaceTable::class,
                ReplaceColumns::class,
                ReplaceValues::class,
                ReplaceConditions::class,
                ReplaceSelect::class
            ])
            ->send();

        return $result['query'];
    }
}