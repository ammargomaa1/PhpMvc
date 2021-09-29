<?php

require './src/Support/helpers.php';
use PHPUnit\Framework\TestCase;
use Illuminate\View\View;
use Dotenv\Dotenv;

class ViewTest extends TestCase{

    protected View $view;
    
    public function setUp():void
    {
        $this->view = new View;
        $dotenv = Dotenv::createImmutable(base_path());
        $dotenv->load();
           
    }
    protected function getNonAccessableMethod(string $name){
        $reflection = new ReflectionClass($this->view);
        $method = $reflection->getMethod($name);
        if($method->isPrivate() || $method->isProtected()){
            $method->setAccessible(true);
        }

        return $method;
    }



    public function test_it_gets_the_base_content()
    {
            
            $this->assertStringContainsString(
                "{{content}}",
                $this->getNonAccessableMethod('getBaseContent')->invoke($this->view)
                
            )
            ;
    }

    
    public function test_it_has_app_name_in_title_from_env_variables()
    {
        
        $this->assertStringContainsString(
            env('APP_NAME'),
            $this->getNonAccessableMethod('getBaseContent')->invoke($this->view)
            
        )
        ;
    }

    public function test_it_does_not_have_content_placeholder()
    {
    
        $this->assertStringNotContainsString(
            '{{content}}',
            $this->getNonAccessableMethod('getViewContent')->invokeArgs($this->view,['home'])
            
        )
        ;
    }

    public function test_it_replaces_view_template_with_content_placeholder_in_layout()
    {
        $this->assertStringContainsString(

            env('APP_NAME'),
            View::make('home')
            
        );
    }



}
