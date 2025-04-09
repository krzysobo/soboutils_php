<?php
namespace Soboutils;

require_once "Exceptions.php";

trait SoboSingletonTrait
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

    /**
     * getInstance() method of singleton
     */
    final public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * alias of getInstance()
     */
    final public static function instance()
    {
        return self::getInstance();
    }

}
