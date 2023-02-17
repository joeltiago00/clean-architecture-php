<?php

namespace Infrastructure\Models;

use Infrastructure\Database\ConnectionResolver;
use Infrastructure\Models\Enums\TypeQueryEnum;
use Infrastructure\Models\Replacers\QueryReplacer;
use Infrastructure\Models\Traits\Builder;
use PDO;
use PDOStatement;

abstract class Model
{
    use Builder;

    protected string $conditions = '';

    protected string $table = '';
    private QueryReplacer $replacer;

    public function __construct()
    {
        $this->replacer = new QueryReplacer();
    }

    private function getConnection(): PDO
    {
        return ConnectionResolver::handle();
    }

    public function create(array $data): int
    {
        $valuesAsArrayForReplace = $this->prepareArrayValuesForReplace($data);

        $valuesAsStringForReplace = $this->arrayValuesForReplaceAsString($valuesAsArrayForReplace);

        $connection = $this->getConnection();

        $stmt = $connection->prepare(
            $this->prepareQuery(
                TypeQueryEnum::INSERT,
                $this->prepareColumns($data),
                $valuesAsStringForReplace,
            )
        );

        $toDatabase = array_combine($valuesAsArrayForReplace, array_values($data));

        $stmt->execute($toDatabase);

        return $connection->lastInsertId();
    }

    private function prepareColumns(array $data): string
    {
        return implode(', ', array_keys($data));
    }

    private function prepareArrayValuesForReplace(array $data): array
    {
        return array_map(fn($key) => sprintf(':%s', $key), array_keys($data));
    }

    private function arrayValuesForReplaceAsString(array $values): string
    {
        return implode(', ', $values);
    }

    public function prepareQuery(TypeQueryEnum $queryEnum, string $columns, string $valuesAsStringForReplace): string
    {
        return $this->replacer->handle([
            'query' => $queryEnum->text(),
            'table' => $this->table,
            'columns' => $columns,
            'values' => $valuesAsStringForReplace
        ]);
    }

    private function prepareModels(PDOStatement $stmt): array
    {
        $list = [];
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while ($result = $stmt->fetch()) {
            $list[] = $result;
        }

        return $list;
    }

    private function getModelPath(array $data): string
    {
        return $data[0]['object']::class ?? throw new \Exception('Invalid model.');
    }

    public function find(int $id): array
    {
        $connection = $this->getConnection();
        $stmt = $connection->prepare(
            $this->replacer->handle([
                'query' => TypeQueryEnum::SELECT->text(),
                'columns' => '*',
                'table' => $this->table,
                'conditions' => $this->where('id', '=', $id)->conditions
            ])
        );

        $stmt->execute();

        return $this->prepareModels($stmt);
    }

    public function __get(string $name)
    {
        // TODO: Implement __get() method.
    }
}