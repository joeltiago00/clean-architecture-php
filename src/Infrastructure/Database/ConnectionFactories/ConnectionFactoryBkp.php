<?php

namespace Infrastructure\Database\ConnectionFactories;

use PDO;
use PDOException;

class ConnectionFactoryBkp
{
    public static function createConnection(): PDO
    {
        $databasePath = sprintf('%s/../../../../database.sqlite', __DIR__);

        try {
            return new PDO(sprintf('sqlite:%s', $databasePath));
        } catch (PDOException $exception) {
            echo sprintf('PDO error: %s', $exception->getMessage());
        }
    }
}