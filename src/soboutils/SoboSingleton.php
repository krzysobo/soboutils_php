<?php

Namespace Soboutils;

require_once "Exceptions.php";

class SoboSingleton
{
    protected static $instance = null;

    protected function __construct()
    {

    }

    final protected function __clone()
    {

    }

    final public function __wakeup()
    {
        throw new SoboSingletonException("one does not simply wake up a singleton!");
    }

    final public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    final public static function instance()
    {
        return self::getInstance();
    }
}
