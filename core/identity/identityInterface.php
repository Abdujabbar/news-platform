<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/16/18
 * Time: 3:29 PM
 */
namespace core\identity;

interface IdentityInterface
{
    public function getId();
    public function setId($id);
}
