<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 3:05 PM
 */

namespace core\database;

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
        if ($cleanErrors) {
            $this->cleanErrors();
        }

        if (!$this->beforeValidate()) {
            return false;
        }



        return $this->afterValidate();
    }


    /**
     * @param $attribute
     * @param $message
     * @throws \Exception
     */
    public function addError($attribute, $message)
    {
        if (property_exists($this, $attribute)) {
            $this->errors[$attribute] = $message;
        } else {
            throw new \Exception(sprintf("Property %s doesn't exists", $attribute));
        }
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



    public function findByCondition($condition = [])
    {
    }

    public function findOne($pk = 0)
    {
    }
}
