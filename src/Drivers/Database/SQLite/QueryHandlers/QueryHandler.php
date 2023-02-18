<?php

namespace Drivers\Database\SQLite\QueryHandlers;

use Drivers\Database\SQLite\QueryHandlers\Contracts\Query as QueryInterface;
use Drivers\Database\SQLite\QueryHandlers\Handlers\Handler;

class QueryHandler implements QueryInterface
{
    public function handle(
        Handler $handler,
        string  $table,
        array   $data,
        string  $conditions = '',
        string  $select = ''
    ): QueryDTO
    {
        $columnsAsArray = $this->columnsAsArray($data);
        $columnsAsString = $this->columnsAsString($columnsAsArray);

        $valueAsArray = $this->prepareValuesAsArrayForReplace($data);
        $valueAsString = $this->arrayValuesAsStringForReplace($valueAsArray);

        $updates = $this->getUpdates($columnsAsArray, $valueAsArray);

        $query = $handler->replacer->handle([
            'query' => $handler->queryEnum->text(),
            'table' => $table,
            'columns' => $columnsAsString,
            'values' => $valueAsString,
            'conditions' => $conditions,
            'select' => $select,
            'updates' => $updates
        ]);

        return new QueryDTO($query, $this->getData($valueAsArray, $data));
    }

    private function columnsAsString(array $data): string
    {
        return implode(', ', $data) ?? '';
    }

    private function prepareValuesAsArrayForReplace(array $data): array
    {
        return array_map(fn($key) => sprintf(':%s', $key), $this->columnsAsArray($data)) ?? [];
    }

    private function arrayValuesAsStringForReplace(array $values): string
    {
        return implode(', ', $values) ?? '';
    }

    private function getData(array $valueAsArray, array $data): array
    {
        return array_combine($valueAsArray, array_values($data));
    }

    private function columnsAsArray(array $data): array
    {
        return array_keys($data) ?? [];
    }

    private function getUpdates(array $columnsAsArray, array $valueAsArray): string
    {
        $set = '';

        foreach (array_combine($columnsAsArray, $valueAsArray) as $key => $value) {
            if (empty($set)) {
                $set .= "$key = $value";

                continue;
            }

            $set .= ", $key = $value";
        }
        return $set;
    }
}