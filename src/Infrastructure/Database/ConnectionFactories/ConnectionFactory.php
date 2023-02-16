<?php

namespace Infrastructure\Database\ConnectionFactories;

use Infrastructure\Database\Contracts\ConnectionFactory as ConnectionFactoryInterface;
use PDO;
use PDOException;

abstract class ConnectionFactory implements ConnectionFactoryInterface
{
    protected static string $type = '';
    protected static string $host = '';
    protected static string $database = '';
    protected static string $user = '';
    protected static string $password = '';

    public static function create(): PDO
    {
        try {
            return new PDO(
                sprintf('%s:host=%s;dbname=%s', self::$type, self::$host, self::$database),
                self::$user,
                self::$password)
                ;
        } catch (PDOException $exception) {
            echo sprintf('PDO error: %s', $exception->getMessage());
        }
    }
}