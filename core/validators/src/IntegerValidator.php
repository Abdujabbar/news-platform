<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 4:35 PM
 */
namespace validators\src;

class IntegerValidator extends Validator
{
    public $min = 0;
    public $max = PHP_INT_MAX;
    protected $error;

    public function validate($input)
    {
        if (!is_int($input)) {
            $this->error = "Value must be an integer";
            return false;
        }

        if ($input < $this->min) {
            $this->error = sprintf("Value cannot be less than %d", $this->min);
            return false;
        }

        if ($input > $this->max) {
            $this->error = sprintf("Value cannot be greater than %d", $this->max);
            return false;
        }
        return true;
    }

    public function between($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
        return $this;
    }

    public function getError()
    {
        return $this->error;
    }
}
