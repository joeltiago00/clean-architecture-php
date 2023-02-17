<?php

namespace Infrastructure\Models\QueryHandlers\Handlers;

use Infrastructure\Models\Enums\TypeQueryEnum;
use Infrastructure\Models\QueryHandlers\Query;
use Infrastructure\Models\QueryHandlers\QueryDTO;
use Infrastructure\Models\Replacers\QueryReplacer;

class Insert extends Query
{
    public function __construct()
    {
        $this->queryEnum = TypeQueryEnum::INSERT;
        $this->replacer = new QueryReplacer();
    }

    public function handle(string $table, array $data, string $conditions = '', string $select = ''): QueryDTO
    {
        $columns = $this->prepareColumns($data);
        $valueAsArray = $this->prepareValuesAsArrayForReplace($data);
        $valueAsString = $this->arrayValuesAsStringForReplace($valueAsArray);

        $query = $this->replacer->handle([
            'query' => $this->queryEnum->text(),
            'table' => $table,
            'columns' => $columns,
            'values' => $valueAsString
        ]);

        return new QueryDTO($query, $this->getData($valueAsArray, $data));
    }
}