<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/16/18
 * Time: 3:15 PM
 */

namespace core;

class Session
{
    protected static $instance;


    private function __construct()
    {
        session_start();
    }

    private function __sleep()
    {
        // TODO: Implement __sleep() method.
    }

    private function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function setFlash($name, $message)
    {
        $_SESSION["flash_" . $name] = $message;
    }

    public function getFlash($name)
    {
        $flash = $_SESSION["flash_" . $name];
        if (!empty($flash)) {
            unset($_SESSION["flash_" . $name]);
        }
        return $flash;
    }


    public function set($key, $input)
    {
        $_SESSION["session_" . $key] = $input;
    }

    public function clear()
    {
        $_SESSION = [];
    }

    public function get($key)
    {
        return !empty($_SESSION["session_" . $key]) ? $_SESSION["session_" . $key] : null;
    }
}
