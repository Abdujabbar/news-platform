<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/11/18
 * Time: 4:24 PM
 */

namespace core\validators\src;

class EmailValidator extends Validator
{
    protected $error = false;

    public function validate($input)
    {
        if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $this->error = "Value must be an email";
            return false;
        }
        return true;
    }

    public function getError()
    {
        return $this->error;
    }
}
