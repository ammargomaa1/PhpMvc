<?php

namespace Illuminate;

use Illuminate\Http\Route;
use Illuminate\Database\DB;
use Illuminate\Database\Managers\MySQLManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Config;
use Illuminate\Support\Session;


class Application{
    protected Route $route;

    protected Request $request;

    protected Response $response;

    protected Config $config;

    protected Session $session;

    protected DB $db;

    public function __construct()
    {
        $this->request = new Request;

        $this->response = new Response;

        $this->route = new Route($this->request,$this->response);

        $this->config = new Config($this->loadConfigurations());

        $this->session = new Session;

        

        $this->db = new DB($this->getDatabaseManager());
        
    }

    public function run()
    {
        $this->db->connect();
        $this->route->resolve();
    }

    protected function loadConfigurations()
    {
        foreach (scandir(config_path()) as $file ) {
            if($file == '.' || $file =='..'){
                continue;
            }
            $filename = explode('.',$file)[0];
            yield $filename => require config_path().$file;
        }
    }

    public function __get($key)
    {
        if (property_exists($this,$key)) {
            return $this->$key;
        }
    }

    protected function getDatabaseManager(){


        return match(env('DB_DRIVER')) {
            
            'mysql' => new MySQLManager,

            default => new MySQLManager

        };


    }
}