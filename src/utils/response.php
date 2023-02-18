<?php

if (!function_exists('returnResponseJson')) {

    function returnResponseJson(mixed $content, int $statusCode): never
    {
        ob_clean();

        header_remove();

        http_response_code($statusCode);

        header('Content-Type: application/json');

        echo json_encode($content);

        exit();
    }
}

if (!function_exists('returnExceptionJson')) {

    function returnExceptionJson(Throwable $throwable): never
    {
        ob_clean();

        header_remove();

        http_response_code($throwable->getCode());

        header('Content-Type: application/json');

        echo json_encode(['error' => $throwable->getMessage()]);

        exit();
    }
}