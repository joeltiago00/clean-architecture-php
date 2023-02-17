<?php


use Infrastructure\Repositories\UserPdoRepository;

require '../vendor/autoload.php';

$repository = new UserPdoRepository();

//$userId = $repository->create([
//    'first_name' => 'joel',
//    'last_name' => 'almeida',
//    'email' => 'joel.almeida@email.com'
//]);

$user = $repository->find($userId);

dd($user);