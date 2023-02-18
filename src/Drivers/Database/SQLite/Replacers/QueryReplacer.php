<?php

namespace Drivers\Database\SQLite\Replacers;

use Drivers\Database\SQLite\Replacers\Replaces\ReplaceColumns;
use Drivers\Database\SQLite\Replacers\Replaces\ReplaceConditions;
use Drivers\Database\SQLite\Replacers\Replaces\ReplaceSelect;
use Drivers\Database\SQLite\Replacers\Replaces\ReplaceTable;
use Drivers\Database\SQLite\Replacers\Replaces\ReplaceUpdates;
use Drivers\Database\SQLite\Replacers\Replaces\ReplaceValues;

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
                ReplaceSelect::class,
                ReplaceUpdates::class
            ])
            ->send();

        return $result['query'];
    }
}