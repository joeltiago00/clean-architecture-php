<?php

namespace Infrastructure\Database\ConnectionFactories;


class MySQLFactory extends ConnectionFactory
{
    protected string $type = 'mysql';

    public function __construct(
        protected string $host,
        protected string $database,
        protected string $user,
        protected string $password
    )
    {
    }
}