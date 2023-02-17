<?php

use Infrastructure\Database\ConnectionResolver;

require '../../../../vendor/autoload.php';

$pdo = ConnectionResolver::handle();
//TODO:: handle this with class...

$pdo->exec(
    'create table users (
        id integer primary key,
        first_name not null,
        last_name text,
        email text not null,
        created_at text,
        updated_at text,
        deleted_at text
    )'
);