<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/17/18
 * Time: 11:25 AM
 */

namespace core\helpers\random;

class RandomGenerator
{
    protected static $instance = null;

    protected $availableChars = "abcdefghijklmnopqrstuvwxyz";

    protected function __construct()
    {
    }

    protected function __sleep()
    {
        // TODO: Implement __sleep() method.
    }

    protected function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }

    protected function __clone()
    {
        // TODO: Implement __clone() method.
    }


    public static function getInstance()
    {
        if (! self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function randomString($length = 10)
    {
        $return = "";


        for ($i = 0; $i < $length; $i++) {
            $return .= $this->availableChars[rand(0, mb_strlen($this->availableChars))];
        }

        return $return;
    }

    public function randInt($min, $max)
    {
        return rand($min, $max);
    }
}
