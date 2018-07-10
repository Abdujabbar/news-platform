<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 4:26 PM
 */

class RequiredValidator implements InterfaceValidator
{
    public function validate($input)
    {
        return !is_null($input);
    }
}