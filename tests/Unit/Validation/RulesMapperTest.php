<?php

use Illuminate\Validation\Rules\EmailRule;
use PHPUnit\Framework\TestCase;
use Illuminate\Validation\RulesMapper;


class RulesMapperTest extends TestCase
{
    public function test_it_returns_an_instance_of_selected_rule()
    {
        $r = RulesMapper::resolve('email');

        $this->assertInstanceOf(EmailRule::class,$r);

    }
}
