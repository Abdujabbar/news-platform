<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 3:05 PM
 */

namespace core\database;

use core\validators\src\ValidateAR;

class ActiveRecord
{
    protected $table;

    protected $primaryKey = 'id';

    protected $errors = [];

    protected $fillable = [];
    /**
     * @var $query Query
     */
    private $query;

    public function __construct($configs = [])
    {
        foreach ($configs as $column => $value) {
            $this->$column = $value;
        }
        $this->query = new Query();
    }


    public function getTable()
    {
        return $this->table;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * function returns array of rules for validating fields
     * sample:
     * [
     *  ['name', 'required']
     *  [['title', 'content'], 'required']
     * ]
     * @return array
     */
    public function rules()
    {
        return [];
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }


    public function __get($name)
    {
        return $this->fillable[$name] ? $this->{$name} : null;
    }

    public function __set($name, $value)
    {
        if ($this->isFillable($name)) {
            $this->{$name} = $value;
        }
    }

    public function isFillable($attribute)
    {
        return in_array($attribute, $this->fillable);
    }



    public function save($validate = true, $cleanErrors = true)
    {
        $valid = $validate ? $this->validate($cleanErrors) : true;
        if ($valid) {
            $fields = [];
            foreach (get_object_vars($this) as $attribute => $value) {
                if ($this->isFillable($attribute)) {
                    $fields[$attribute] = $value;
                }
            }
            if ($this->{$this->primaryKey}) {
                return $this->query->update($this->getTable(), $fields, [['id', '=', $this->{$this->primaryKey}]]);
            } else {
                return $this->query->insert($this->getTable(), $fields);
            }
        }

        return false;
    }


    public function validate($cleanErrors = true)
    {
        if ($cleanErrors) {
            $this->cleanErrors();
        }

        if (!$this->beforeValidate()) {
            return false;
        }


        $validator = new ValidateAR();

        $validator->validate($this);


        return $this->afterValidate();
    }


    /**
     * @param $attribute
     * @param $message
     */
    public function addError($attribute, $message)
    {
        if ($this->isFillable($attribute)) {
            $this->errors[$attribute] = $message;
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
        return count($this->getErrors()) > 0;
    }


    public function cleanErrors()
    {
        $this->errors = [];
    }

    public function fillOut($attributes = [])
    {
        foreach ($attributes as $attribute => $value) {
            if ($attribute == $this->getPrimaryKey()) {
                $this->$attribute = $value;
                continue;
            }
            if ($this->isFillable($attribute)) {
                $this->$attribute = $value;
            }
        }

        return $this;
    }

    public function rawToModel($array)
    {
        return (new static())->fillOut($array);
    }

    public static function findOne($pk = 0)
    {
        $class = (new static());
        $object = $class->query->select("*")->from($class->getTable())->where([[$class->getPrimaryKey(), '=', $pk]])->one();
        return $class->rawToModel((array)$object);
    }

    public static function findByConditions($conditions = [])
    {
        $class = (new static());
        $objects = $class->query->select("*")->from($class->getTable())->where($conditions)->all();
        $models = [];

        foreach ($objects as $object) {
            $models[] = $class->rawToModel((array)$object);
        }

        return $models;
    }

    public static function findByCondition($column, $operation, $value)
    {
        $class = (new static());
        $object = $class->query->select("*")->from($class->getTable())->where([[
            $column,
            $operation,
            $value]
        ])->one();

        return $class->rawToModel((array)$object);
    }
}
