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
    protected $id;

    public function getId()
    {
        return $this->id;
    }
}
