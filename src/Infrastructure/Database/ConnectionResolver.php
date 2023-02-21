<?php

namespace Infrastructure\Database;

use Infrastructure\Database\ConnectionFactories\MySQLFactory;
use Infrastructure\Database\ConnectionFactories\SQLiteFactory;
use Exception;
use PDO;

class ConnectionResolver
{
    /**
     * @throws Exception
     */
    public static function handle(): PDO
    {
        return match ('sqlite') {
            'sqlite' => (new SQLiteFactory())->create(),
            'mysql' => (new MySQLFactory('', '', '', ''))->create(),
            default => throw new Exception('PDO not configured for this database.')
        };
    }
}