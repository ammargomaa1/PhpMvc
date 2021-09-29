<?php

require_once './src/Support/helpers.php';

use Illuminate\Validation\Validator;
use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{
    public function setUp():void{
        #code

    }

    public function test_it_gets_field_value()
    {
        $v = new Validator;

        $v->make([
            'username'=> 'ammar',
            'email' => 'ammargomaa1@gmail.com',
            'password'=>123456
        ]);

        $this->assertEquals('ammargomaa1@gmail.com',$v->getFieldValue('email'));
    }

    public function test_it_passes_the_validation()
    {
        $v = new Validator;
        $v->setRules([
            'username'=>['required'],
            'email'=>['required','email']
        ]);
        $v->make([
            'username'=> 'ammar',
            'email' => 'ammargomaa1@gmail.com',
            'password'=>123456
        ]);

        

        $this->assertTrue($v->passes());
    }

    public function test_it_does_not_pass_the_validation()
    {
        $v = new Validator;
        $v->setRules([
            'username'=>['required'],
            'email'=>['required','email']
        ]);
        $v->make([
            'username'=> '',
            'email' => 'ammargomaa1@gmail.com',
            'password'=>123456
        ]);

        

        $this->assertFalse($v->passes());
    }

    
}
