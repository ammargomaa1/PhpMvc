<?php

namespace Illuminate\Validation;

use Illuminate\Support\Arr;

class ErrorBag
{
    protected array $errors = [];

    public function add($field,$message)
    {
        $this->errors[$field][]=$message;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function first()
    {
        return Arr::first($this->errors);
    }
}