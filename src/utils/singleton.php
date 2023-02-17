<?php

if (!function_exists('singleton')) {

    function singleton(string $class, ...$parameters)
    {
        $singleton = Singleton::getInstance();

        return $singleton->getInstanceFor($class, ...$parameters);
    }
}

class Singleton
{
    private static array $instances = [];

    private function __construct()
    {
    }

    public function getInstanceFor(string $class, ...$parameters)
    {
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = $this->setInstance($class, ...$parameters);
        }

        return self::$instances[$class];
    }

    public static function getInstance()
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    private function setInstance(string $class, ...$parameters): mixed
    {
        if (!empty($parameters))
            return $this->setInstanceWithParameters($class, ...$parameters);

        return $this->setInstanceWithoutParameters($class);
    }

    private function setInstanceWithParameters(string $class, ...$parameters): mixed
    {
        return self::$instances[$class] = new $class(...$parameters);
    }

    private function setInstanceWithoutParameters(string $class): mixed
    {
        return self::$instances[$class] = new $class();
    }

    private function __clone(): void
    {
    }

    public function __wakeup(): void
    {
    }
}