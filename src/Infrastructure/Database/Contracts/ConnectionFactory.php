<?php

namespace Infrastructure\Database\Contracts;

use PDO;

interface ConnectionFactory
{
    public static function create(): PDO;
}