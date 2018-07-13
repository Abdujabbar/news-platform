<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 4:26 PM
 */
namespace core\validators\src;

class RequiredValidator extends Validator
{
    protected $error;
    public function validate($input)
    {
        if (!is_null($input)) {
            return true;
        }

        $this->error = "Value must be a string";
        return false;
    }
    public function getError()
    {
        return $this->error;
    }
}
