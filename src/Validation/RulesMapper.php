<?php

namespace Illuminate\Validation;

use Illuminate\Validation\Rules\BetweenRule;
use Illuminate\Validation\Rules\EmailRule;
use Illuminate\Validation\Rules\RequireRule;
use Illuminate\Validation\Rules\ConfirmedRule;

trait RulesMapper
{
    protected static $map = [
        'required' => RequireRule::class,
        'email' => EmailRule::class,
        'confirmed'=>ConfirmedRule::class,
        'between'=>BetweenRule::class
    ];
    public static function resolve(string $rule, $options=null)
    {
        
        return new static::$map[$rule]($options);
    }
}