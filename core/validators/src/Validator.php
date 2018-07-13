<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 4:25 PM
 */
namespace core\validators\src;

abstract class Validator
{
    abstract public function validate($input);
    abstract public function getError();
    public function __construct($options = [])
    {
        foreach ($options as $option => $value) {
            if (property_exists($this, $option)) {
                $this->$option = $value;
            }
        }
    }
}
