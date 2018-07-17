<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/16/18
 * Time: 4:11 PM
 */

namespace models;

use core\database\ActiveRecord;
use core\identity\AuthManager;
use core\identity\UserIdentity;

class User extends ActiveRecord
{
    protected $table = 'users';

    protected $fillable = [
        'username',
        'password_hash',
    ];


    public function validatePassword($password)
    {
        return \Security::validatePassword($password, $this->password_hash);
    }

    public function login($password)
    {
        if ($this->validate($password)) {
            $userIdentity = new UserIdentity();
            $userIdentity->setId($this->{$this->getPrimaryKey()});
            $authManager = new AuthManager();
            return $authManager->login($userIdentity);
        }
        return false;
    }
}
