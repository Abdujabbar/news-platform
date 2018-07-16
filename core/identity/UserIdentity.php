<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/16/18
 * Time: 3:30 PM
 */
namespace core\identity;
class UserIdentity implements IdentityInterface
{
    protected $options = [];
    public function __construct($options = [])
    {
        $this->options = $options;
    }

    public function __set($name, $input)
    {
        // TODO: Implement __set() method.
        $this->options[$name] = $input;
    }

    public function __get($name)
    {
        return !empty($this->options[$name]) ? $this->options[$name] : null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return serialize($this);
    }


}