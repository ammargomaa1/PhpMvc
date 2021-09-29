<?php

namespace App\Validation\Rules;

use Illuminate\Validation\Rules\Contract\Rule;

class AlnumRule implements Rule
{
    public function apply($field,$value,$data=[])
    {
        return preg_match('/^[a-zA-Z0-9_-]+$/',$value);
    }

    public function __toString()
    {
        return "%s must be alpha numeric only";
    }
}