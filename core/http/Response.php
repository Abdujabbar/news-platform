<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 3:16 PM
 */

namespace core\http;

use core\View;

class Response
{
    public static function setHeader($header)
    {
        header($header);
    }

    public static function setStatus($code = 200)
    {
        if ($code < 100 || $code > 600) {
            throw new \Exception("Wrong status code");
        }

        http_response_code($code);
    }

    public static function toJSON($data)
    {
        self::setHeader("Content-type: application/json");
        echo JSON::encode($data);
    }

    public static function NotFound($message = '')
    {
        $view = new View();
        try {
            self::setStatus(404);

            $view->render("errors/notfound", ['message' =>  $message]);
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }
    }
}
