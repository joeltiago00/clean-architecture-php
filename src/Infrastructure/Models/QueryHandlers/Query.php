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
        $columns = $this->prepareColumns($data) ?? '';
        $valueAsArray = $this->prepareValuesAsArrayForReplace($data) ?? [];
        $valueAsString = $this->arrayValuesAsStringForReplace($valueAsArray) ?? '';

        $query = $this->replacer->handle([
            'query' => $this->queryEnum->text(),
            'table' => $table,
            'columns' => $columns,
            'values' => $valueAsString,
            'conditions' => $conditions,
            'select' => $select
        ]);

        return new QueryDTO($query, $this->getData($valueAsArray, $data));
    }

    protected function prepareColumns(array $data): string
    {
        return implode(', ', array_keys($data));
    }

    protected function prepareValuesAsArrayForReplace(array $data): array
    {
        return array_map(fn($key) => sprintf(':%s', $key), array_keys($data));
    }

    protected function arrayValuesAsStringForReplace(array $values): string
    {
        return implode(', ', $values);
    }

    protected function getData(array $valueAsArray, array $data): array
    {
        return array_combine($valueAsArray, array_values($data));
    }
}