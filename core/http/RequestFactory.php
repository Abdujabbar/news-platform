<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/19/18
 * Time: 12:04 PM
 */

namespace core\http;


class RequestFactory
{
    public static function createFromGlobals() {
        $request = new Request();
        return $request->withQueryParams($_GET)->withParsedBody($_POST);
    }
}