<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/16/18
 * Time: 3:37 PM
 */

namespace core\identity;

use core\Session;

class AuthManager
{
    /**
     * @var $_user IdentityInterface
     */
    protected $_user;

    public function __construct()
    {
        $this->_user = Session::getInstance()->get('user');
    }

    public function login(IdentityInterface $user)
    {
        Session::getInstance()->set('user', $user);
        $this->setUser($user);
        return $user->getId();
    }


    public function setUser(IdentityInterface $user)
    {
        $this->_user = $user;
    }

    public function getUser()
    {
        return $this->_user;
    }


    public function logout()
    {
        Session::getInstance()->clear();
    }


    public function isGuest()
    {
        return $this->_user === null;
    }
}
