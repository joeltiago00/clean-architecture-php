<?php

namespace Drivers\Database\SQLite;

use Drivers\Database\SQLite\Contracts\Model as ModelInterface;
use Drivers\Database\SQLite\QueryHandlers\Handlers\Delete;
use Drivers\Database\SQLite\QueryHandlers\Handlers\Insert;
use Drivers\Database\SQLite\QueryHandlers\Handlers\Select;
use Drivers\Database\SQLite\QueryHandlers\Handlers\Update;
use Drivers\Database\SQLite\QueryHandlers\QueryHandler;
use Drivers\Database\SQLite\Traits\Builder;
use Infrastructure\Database\ConnectionResolver;
use PDO;
use PDOStatement;

abstract class Model implements ModelInterface
{
    use Builder;

    protected string $select = '*';
    protected string $conditions = '';
    protected string $table = '';
    private PDO $connection;
    private QueryHandler $queryHandler;

    public function __construct()
    {
        $this->connection = ConnectionResolver::handle();
        $this->queryHandler = new QueryHandler();
    }

    public function create(array $data): array
    {
        $query = $this->queryHandler->handle(singleton(Insert::class), $this->table, $data);

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

        $query = $this->queryHandler->handle(
            singleton(Select::class),
            $this->table,
            [],
            $this->conditions,
            $this->select
        );

        $stmt = $this->connection->prepare($query->text);

        $stmt->execute($query->data);

        return $this->prepareModels($stmt);
    }

    public function get(): array
    {
        $query = $this->queryHandler->handle(
            singleton(Select::class),
            $this->table,
            [],
            $this->conditions,
            $this->select
        );

        $stmt = $this->connection->prepare($query->text);

        $stmt->execute();

        return $this->prepareModels($stmt);
    }

    public function update(array $data): bool
    {
        $query = $this->queryHandler->handle(singleton(Update::class), $this->table, $data, $this->conditions);

        $stmt = $this->connection->prepare($query->text);

        return $stmt->execute($query->data);
    }

    public function delete(): bool
    {
        $query = $this->queryHandler->handle(
            singleton(Delete::class),
            $this->table,
            [],
            $this->conditions,
            $this->select
        );

        $stmt = $this->connection->prepare($query->text);

        return $stmt->execute();
    }
}