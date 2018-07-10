<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 3:16 PM
 */

namespace core\components;

class Request
{
    public function __construct()
    {
    }


    public static function parseRoute()
    {
        $defaultController = "main";
        $defaultAction = "index";
        if (!empty($_SERVER['PATH_INFO'])) {
            $route = explode("/", trim($_SERVER["PATH_INFO"], "/"));
            if (count($route)) {
                $defaultController = array_shift($route);
            }

            if (count($route)) {
                $defaultAction = array_shift($route);
            }
        }

        return [
            'class' =>  ucfirst($defaultController) . CONTROLLER_SUFFIX,
            'action' => ACTION_PREFIX . ucfirst($defaultAction),
        ];
    }
}
