<?php

use Illuminate\Validation\Rules\ConfirmedRule;
use Illuminate\Validation\Rules\Contract\Rule;
use Illuminate\Validation\Rules\EmailRule;
use Illuminate\Validation\Rules\RequireRule;
use PHPUnit\Framework\TestCase;
use Illuminate\Validation\RulesResolver;

class RulesResolverTest extends TestCase
{
    public function test_it_resolves_multiple_rules_from_a_separated_string()
    {
        $rules = 'required|email|confirmed';

        $this->assertContainsOnlyInstancesOf(Rule::class,RulesResolver::make($rules));
    }

    public function test_it_resolves_an_array_of_rules()
    {
        $rules = ['required','email','confirmed'];
        $this->assertContainsOnlyInstancesOf(Rule::class,RulesResolver::make($rules));

    }

    public function test_it_resolves_a_single_string_rule()
    {
        $rule = 'required';
        $this->assertInstanceOf(RequireRule::class,RulesResolver::make($rule)[0]);
    }
}
