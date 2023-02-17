<?php

use App\Models\User;
use Infrastructure\Repositories\UserPdoRepository;

require '../vendor/autoload.php';
require '../src/public/index.php';

$repository = new UserPdoRepository();

$user = new User();

$query = $user
    ->select('id')
//    ->where('first_name', '=', 'joel')
    ->where('id', '=', 3)
    ->update([
        'first_name' => 'joão',
        'last_name' => 'santos'
    ]);

dd($query);