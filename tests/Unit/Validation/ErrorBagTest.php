<?php
require_once './src/Support/helpers.php';

use Illuminate\Validation\ErrorBag;
use PHPUnit\Framework\TestCase;

class ErrorBagTest extends TestCase
{
    public function test_it_gets_the_errors_as_an_array()
    {
        $e = new ErrorBag;
        $e->add('required','This field is required');

        $this->assertEquals(['This field is required'],$e->getErrors()['required']);
    }

    public function test_it_gets_the_first_error()
    {
        $e = new ErrorBag;
        $e->add('required','This field is required');
        $e->add('email','This field must be an email');

        $this->assertEquals(['This field is required'],$e->first());
    }
}
