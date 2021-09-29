<?php

namespace Illuminate\Validation\Rules;

use Illuminate\Validation\Rules\Contract\Rule;

class RequireRule implements Rule
{
    public function apply($field,$value,$data = [])
    {
        return !empty($value);
    }

    public function __toString()
    {
        return 'This %s is required';
    }
}
