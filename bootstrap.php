<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 12:04 PM
 */

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $file = APP_ROOT .  str_replace("\\", DIRECTORY_SEPARATOR, $class) . PHP_EXT;
            if (file_exists($file)) {
                require_once($file);
                return true;
            }
            return false;
        });
    }
}



Autoloader::register();
