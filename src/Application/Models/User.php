<?php

namespace App\Models;

use Infrastructure\Models\SQLite\Model;

class User extends Model
{
    protected string $table = 'users';
}