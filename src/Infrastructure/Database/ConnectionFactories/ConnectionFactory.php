<?php

namespace Infrastructure\Database\ConnectionFactories;

use Infrastructure\Database\Contracts\ConnectionFactory as ConnectionFactoryInterface;
use PDO;
use PDOException;

abstract class ConnectionFactory implements ConnectionFactoryInterface
{
    protected string $type = '';
    protected string $host = '';
    protected string $database = '';
    protected string $user = '';
    protected string $password = '';

    public function create(): PDO
    {
        try {
            $connection = new PDO(
                sprintf('%s:host=%s;dbname=%s', $this->type, $this->host, $this->database),
                $this->user,
                $this->password);

            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            echo sprintf('PDO error: %s', $exception->getMessage());
            exit();
        }

        return $connection;
    }
}