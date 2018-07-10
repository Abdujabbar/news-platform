<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 7/10/18
 * Time: 5:04 PM
 */
namespace validators\src;

class ValidateEntity
{
    protected $entity;

    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    public function validate()
    {
        if (method_exists($this->entity, 'rules')) {
            $rules = $this->entity->rules();
        }

        if (empty($rules)) {
            return true;
        }



        foreach ($rules as $rule) {
            if (is_array($rule[0])) {
            } else {
                $validatorClass = ucfirst($rule[1]) . "Validator";
                if (class_exists($validatorClass)) {
                    $validatorObject = new $validatorClass();

                    if (!$validatorObject->validate($this->entity->{$rule[0]})) {
                        $this->entity->addError($rule[0], $validatorObject->getError());
                    }
                } else {
                    throw new \Exception("Validator %s doesn't exists", $validatorClass);
                }
            }
        }
    }
}
