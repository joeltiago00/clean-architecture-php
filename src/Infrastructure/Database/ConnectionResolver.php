<?php

namespace Infrastructure\Database;

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
        return match (config('app.database.connection')) {
            'sqlite' => SQLiteFactory::create(),
            default => throw new Exception('PDO not configured for this database.')
        };
    }
}