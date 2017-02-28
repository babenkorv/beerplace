<?php

namespace vendor;

class App
{
    public static $container;

    private static $config = [];

    public function run($container_config, $config)
    {
        self::$container = new Container($container_config);
        self::$config = $config;
    }

    public static function getProperty($propertyName)
    {
        if (isset(self::$config[$propertyName])) {
            return self::$config[$propertyName];
        } else {
            throw new \Exception("Property with name $propertyName is not found");
        }
    }
}