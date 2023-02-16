<?php

namespace Infrastructure\Database\ConnectionFactories;

use Infrastructure\Database\ConnectionFactories\ConnectionFactory;use PDO;
use PDOException;

class SQLiteFactory extends ConnectionFactory
{
    protected static string $type = 'sqlite';

    public static function create(): PDO
    {
        $databasePath = sprintf('%s/../../../../database.sqlite', __DIR__);

        try {
            return new PDO(sprintf('sqlite:%s', $databasePath));
        } catch (PDOException $exception) {
            echo sprintf('PDO error: %s', $exception->getMessage());
        }
    }
}