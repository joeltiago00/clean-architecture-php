<?php

namespace Infrastructure\Database\Contracts;

use PDO;

interface ConnectionFactory
{
    public function create(): PDO;
}