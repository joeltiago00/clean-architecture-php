<?php

namespace Infrastructure\Models;

use Infrastructure\Database\ConnectionResolver;
use Infrastructure\Models\Enums\TypeQueryEnum;
use Infrastructure\Models\QueryHandlers\Handlers\Insert;
use Infrastructure\Models\QueryHandlers\Handlers\Select;
use Infrastructure\Models\Replacers\QueryReplacer;
use Infrastructure\Models\Traits\Builder;
use PDO;
use PDOStatement;

abstract class Model
{
    use Builder;

    protected array $params = [];
    protected string $select = '*';
    protected string $conditions = '';
    protected string $table = '';
    private PDO $connection;
    private QueryReplacer $replacer;
    private Insert $insertHandler;
    private Select $selectHandler;

    public function __construct()
    {
        $this->connection = ConnectionResolver::handle();
        $this->replacer = new QueryReplacer();
        $this->insertHandler = new Insert();
        $this->selectHandler = new Select();
    }

    public function create(array $data): array
    {
        $query = $this->insertHandler->handle($this->table, $data);

        $stmt = $this->connection->prepare($query->text);

        $stmt->execute($query->data);

        return $this->find($this->connection->lastInsertId());
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

    public function find(int $id): array
    {
        $this->where('id', '=', $id);

        $query = $this->selectHandler->handle($this->table, [],$this->conditions, $this->select);

        $stmt = $this->connection->prepare($query->text);

        $stmt->execute($query->data);

        return $this->prepareModels($stmt);
    }

    public function get(): array
    {
        $query = $this->selectHandler->handle($this->table, [],$this->conditions, $this->select);

        $stmt = $this->connection->prepare($query->text);

        $stmt->execute();

        return $this->prepareModels($stmt);
    }
}