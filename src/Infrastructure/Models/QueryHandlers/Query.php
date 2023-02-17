<?php

namespace Infrastructure\Models\QueryHandlers;

use Infrastructure\Models\Enums\TypeQueryEnum;
use Infrastructure\Models\Replacers\Replacer;

abstract class Query
{
    protected TypeQueryEnum $queryEnum;
    protected Replacer $replacer;

    public function handle(string $table, array $data, string $conditions = '',  string $select = ''): QueryDTO
    {
        $columnsAsArray = $this->columnsAsArray($data);
        $columnsAsString = $this->columnsAsString($columnsAsArray);

        $valueAsArray = $this->prepareValuesAsArrayForReplace($data);
        $valueAsString = $this->arrayValuesAsStringForReplace($valueAsArray);

        $updates = $this->getUpdates($columnsAsArray, $valueAsArray);

        $query = $this->replacer->handle([
            'query' => $this->queryEnum->text(),
            'table' => $table,
            'columns' => $columnsAsString,
            'values' => $valueAsString,
            'conditions' => $conditions,
            'select' => $select,
            'updates' => $updates
        ]);

        return new QueryDTO($query, $this->getData($valueAsArray, $data));
    }

    protected function columnsAsString(array $data): string
    {
        return implode(', ', $data) ?? '';
    }

    protected function prepareValuesAsArrayForReplace(array $data): array
    {
        return array_map(fn($key) => sprintf(':%s', $key), $this->columnsAsArray($data)) ?? [];
    }

    protected function arrayValuesAsStringForReplace(array $values): string
    {
        return implode(', ', $values) ?? '';
    }

    protected function getData(array $valueAsArray, array $data): array
    {
        return array_combine($valueAsArray, array_values($data));
    }

    public function columnsAsArray(array $data): array
    {
        return array_keys($data) ?? [];
    }

    public function getUpdates(array $columnsAsArray, array $valueAsArray): string
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