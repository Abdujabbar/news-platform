<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 3:16 PM
 */

namespace core\http;

class Request
{
    public function __construct()
    {
    }


    public static function parseRoute()
    {
        $defaultController = "main";
        $defaultAction = "index";
        $pathInfo = trim($_SERVER['PATH_INFO'], "/");

        if (!empty($pathInfo)) {

            $route = explode("/", $pathInfo);
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
