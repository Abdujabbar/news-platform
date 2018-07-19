<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 3:19 PM
 */
namespace core\outer;

class JSON
{
    public static function encode($value, $options = 0, $depth = 512)
    {
        return json_encode($value, $options, $depth);
    }


    public static function decode($json, $assoc = false, $depth = 512, $options = 0)
    {
        return json_decode($json, $assoc, $depth, $options);
    }
}
