<?php

use JetBrains\PhpStorm\NoReturn;

if (!function_exists('dd')) {
    function dd(...$vars): never
    {
        var_dump(...$vars);

        exit();
    }
}