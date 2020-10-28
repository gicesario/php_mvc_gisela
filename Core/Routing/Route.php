<?php

namespace Core\Routing
{
    class Route
    {
        public static $routeList = Array();
        public $method;
        public $prefix;
        public $controller;
        public $action;
        public $parameters;

        public static $group = Array();

        public function __construct($method, $uri, $controller, $action) {
            $this->method = $method;
            $this->uri = $uri;
            $this->controller = $controller;
            $this->action = $action;
        }

        public static function get($uri, $action){
            self::addRoute('GET', $uri, $action);
        }        

        public static function post($uri, $action){
            self::addRoute('POST', $uri, $action);
        }

        public static function put($uri, $action){
            self::addRoute('PUT', $uri, $action);
        }

        public static function delete($uri, $action){
            self::addRoute('DELETE', $uri, $action);
        }

        public static function group(Array $params, callable $callback){
            array_push(self::$group, $params);
            $callback();
            array_pop(self::$group);
        }

        private static function addRoute($method, $uri, $action){
            $actionArray = explode('@',$action);
            $controller = count($actionArray) == 2 ? $actionArray[0] : '';
            $action = count($actionArray) == 1 ? $actionArray[0] : $actionArray[1];
            $route = new Route($method, $uri, $controller, $action);
            $route->setGroupParams();
            self::$routeList[] = $route;
        }

        private function setGroupParams(){
            foreach(self::$group as $params){
                $this->prefix = isset($params['prefix']) ? $this->prefix.'/'.$params['prefix'] : $this->prefix;
                $this->controller = isset($params['controller']) ? $params['controller'] : $this->controller;
            }
        }

    }
}