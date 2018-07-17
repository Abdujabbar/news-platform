<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/17/18
 * Time: 10:58 AM
 */

class Security
{
    public static function generatePassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function validatePassword($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
