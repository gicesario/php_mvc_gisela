<?php

namespace Core;

use Core\Routing\Router;

class App {    
    
    public $router;

    public function __construct() {   
        Session::start();
        $this->contructRoutes();
        $this->router = new Router();
    } 
    
    public function Start(){
        $this->router->dispatchRoute();
    }

    public function contructRoutes(){
        require_once 'Routes.php';
    }

    private function exibirCGI() {
        echo '<pre>';
        print_r($_SERVER);
        echo '</pre>';
    }
}

