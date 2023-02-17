<?php

use App\Models\User;
use Infrastructure\Repositories\UserPdoRepository;

require '../vendor/autoload.php';
require '../src/public/index.php';

$repository = new UserPdoRepository();

$user = new User();

$query = $user
//    ->where('first_name', '=', 'joel')
    ->where('id', '=', 3)
    ->delete();

dd($query);