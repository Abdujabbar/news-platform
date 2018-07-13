<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 5:04 PM
 */
namespace core\validators\src;

use core\database\ActiveRecord;

class ValidateAR
{
    public function validate(ActiveRecord &$entity)
    {
        if (method_exists($entity, 'rules')) {
            $rules = $entity->rules();
        }

        if (empty($rules)) {
            return;
        }

        foreach ($rules as $rule) {
            $validatorClass = __NAMESPACE__ . "\\" .  ucfirst($rule[1]) . "Validator";
            if (is_array($rule[0])) {
                foreach($rule[0] as $r) {
                    $this->validateAttribute($entity, $r, $validatorClass);
                }
            } else {
                $this->validateAttribute($entity, $rule[0], $validatorClass);
            }
        }
    }

    /**
     * @param $entity
     * @param $attribute
     * @param $validatorClass
     */
    public function validateAttribute($entity, $attribute, $validatorClass) {
        if (class_exists($validatorClass)) {
            $validatorObject = new $validatorClass();
            if (!$validatorObject->validate($entity->{$attribute})) {
                $entity->addError($attribute, $attribute . ": " . $validatorObject->getError());
            }
        } else {
            echo sprintf("Validator %s doesn't exists: on line %s in file %s", $validatorClass, __LINE__, __FILE__);
            die();
        }
    }
}
