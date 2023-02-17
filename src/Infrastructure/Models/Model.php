<?php

namespace Infrastructure\Models;

use Infrastructure\Database\ConnectionResolver;
use Infrastructure\Models\QueryHandlers\Handlers\Delete;
use Infrastructure\Models\QueryHandlers\Handlers\Insert;
use Infrastructure\Models\QueryHandlers\Handlers\Select;
use Infrastructure\Models\QueryHandlers\Handlers\Update;
use Infrastructure\Models\Traits\Builder;
use PDO;
use PDOStatement;

abstract class Model
{
    use Builder;

    protected string $select = '*';
    protected string $conditions = '';
    protected string $table = '';
    private PDO $connection;
    private Insert $insertHandler;
    private Select $selectHandler;
    private Update $updateHandler;
    private Delete $deleteHandler;

    public function __construct()
    {
        $this->connection = ConnectionResolver::handle();
        $this->insertHandler = new Insert();
        $this->selectHandler = new Select();
        $this->updateHandler = new Update();
        $this->deleteHandler = new Delete();
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

    public function update(array $data): bool
    {
        $query = $this->updateHandler->handle($this->table, $data, $this->conditions);

        $stmt = $this->connection->prepare($query->text);

        return $stmt->execute($query->data);
    }

    public function delete(): bool
    {
        $query = $this->deleteHandler->handle($this->table, [],$this->conditions, $this->select);
//dd($query);
        $stmt = $this->connection->prepare($query->text);

        return $stmt->execute();
    }
}