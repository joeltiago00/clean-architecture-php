<?php

use App\Actions\User\UserStore;
use App\Validators\User\UserStoreValidator;
use Infrastructure\Repositories\UserPdoRepository;
use Interfaces\Http\Controllers\UserStoreController;

require '../vendor/autoload.php';
require '../src/public/index.php';

$repository = new UserPdoRepository();
$action = new UserStore($repository);
$validator = new UserStoreValidator($repository);

$controller = new UserStoreController($action, $validator);

$controller->__invoke($_POST);