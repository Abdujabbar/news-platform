<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/19/18
 * Time: 12:11 PM
 */

namespace core\http;


class Router
{
    public static function parse()
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