<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 2:24 PM
 */

namespace core;

final class Configs
{
    protected static $instance = null;
    protected $options = [];

    protected function __construct($options = [])
    {
        $this->options = $options;
    }

    protected function __clone()
    {
        // TODO: Implement __clone() method.
    }

    protected function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }

    protected function __sleep()
    {
        // TODO: Implement __sleep() method.
    }


    public static function getInstance($options = [])
    {
        if (!self::$instance) {
            self::$instance = new self($options);
        }
        return self::$instance;
    }

    public function __get($name)
    {
        return array_key_exists($name, $this->options) ? $this->options[$name] : null;
    }

    public function __set($name, $value)
    {
        $this->options[$name] = $value;
    }
}
