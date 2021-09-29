<?php

namespace Illuminate\Validation;
use Illuminate\Validation\Rules\Contract\Rule;



class Validator
{
    protected array $data = [];

    protected array $aliases = [];

    protected array $rules = [];

    protected ErrorBag $errorBag;

   

    public function make($data)
    {
        $this->data = $data;
        $this->errorBag = new ErrorBag();
        $this->validate();
    }
    public function setRules($rules)
    {
        $this->rules = $rules;
    }

    protected function validate()
    {
        foreach ($this->rules as $field => $rules) {
            
            foreach (RulesResolver::make($rules) as $rule) {

                $this->applyRule($field,$rule);
            }
        }

    }

    public function applyRule($field, Rule $rule)
    {
        if(! $rule->apply($field,$this->getFieldValue($field),$this->data)){
            $this->errorBag->add($field,Message::generate($rule,$field));
        }
    }

    public function getFieldValue($filed)
    {
        return $this->data[$filed];
    }

    public function passes()
    {
        return empty($this->errors());
    }

    public function errors($field = null)
    {
        return $field ? $this->errorBag->getErrors()[$field] : $this->errorBag->getErrors();
    }
}