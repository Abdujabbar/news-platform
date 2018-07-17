<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/17/18
 * Time: 10:43 AM
 */
namespace core\exceptions;

class AttributeNotExistsException extends \Exception
{
    protected $message = "Attribute doesn't exists";
}
