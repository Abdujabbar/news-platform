<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 4:55 PM
 */
namespace validators\src;

class StringValidator implements InterfaceValidator
{
    protected $error;
    public $min;
    public $max;

    public function validate($input)
    {
        if (!is_string($input)) {
            $this->error = "Value must be string";
            return false;
        }

        if (strlen($input) < $this->min) {
            $this->error = sprintf("Minimum length of value must be %d", $this->min);
            return false;
        }

        if (strlen($input) > $this->max) {
            $this->error = sprintf("Maximum length of value cannot be greater than %d", $this->max);
            return false;
        }

        return true;
    }


    public function getError()
    {
        return $this->error;
    }

    public function length($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
    }
}
