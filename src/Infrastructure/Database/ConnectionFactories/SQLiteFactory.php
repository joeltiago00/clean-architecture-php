<?php

namespace Infrastructure\Database\ConnectionFactories;

use Infrastructure\Database\ConnectionFactories\ConnectionFactory;use PDO;
use PDOException;

class SQLiteFactory extends ConnectionFactory
{
    protected string $type = 'sqlite';

    public function create(): PDO
    {
        $databasePath = sprintf('%s/../../../../database.sqlite', __DIR__);

        try {
            $connection = singleton(PDO::class, sprintf('%s:%s', $this->type, $databasePath));

            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            echo sprintf('PDO error: %s', $exception->getMessage());
            exit();
        }

        return $connection;
    }
}