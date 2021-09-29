<?php

use Illuminate\Validation\Message;
use Illuminate\Validation\Rules\Contract\Rule;
use Illuminate\Validation\Rules\RequireRule;
use PHPUnit\Framework\TestCase;

require_once './src/Support/helpers.php';

class MessageTest extends TestCase
{
    public function test_it_generates_error_message()
    {
        $rule = new RequireRule;
        $message = Message::generate($rule,'user');

        $this->assertEquals('This user is required',$message);
    }
}
