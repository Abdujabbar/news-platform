<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 3:05 PM
 */

namespace core\components;

class ActiveRecord
{
    protected $tableName;

    protected $primaryKey = 'id';

    protected $errors = [];

    public function rules()
    {
        return [];
    }


    public function save($validate = false, $cleanErrors = true)
    {

    }


    public function validate($cleanErrors = true)
    {
        if($cleanErrors) {
            $this->cleanErrors();
        }

        if(!$this->beforeValidate())
            return false;





        return $this->afterValidate();

    }

    public function beforeValidate()
    {
        return !$this->hasErrors();
    }


    public function afterValidate()
    {
        return !$this->hasErrors();
    }


    public function hasErrors()
    {
        return count($this->errors);
    }


    public function cleanErrors()
    {
        $this->errors = [];
    }



}
