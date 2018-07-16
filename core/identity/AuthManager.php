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
    protected $_user;
    public function __construct()
    {
        $this->_user = Session::getInstance()->get('user');


    }

    public function login(User $user) {
           if(!$this->isGuest()) {
               throw new \Exception("You are already logged in.");
           }
           Session::getInstance()->set('user', $user);
           $this->_user = $user;
           return $user->getId();
    }


    public function logout() {
        Session::getInstance()->clear();
    }


    public function isGuest() {
        return $this->_user === null;
    }

    public function getUser() {
        return Session::getInstance()->get('user');
    }

}