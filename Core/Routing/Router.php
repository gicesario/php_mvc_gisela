<?php
namespace Core\Routing
{
    class Router {
        
        private $uriRequest;
        private $requestMethod;
        private $defaultControllerPath = "App/Controllers/";
        private $params = null;

        public function __construct() {
            $this->uriRequest = $_SERVER['REQUEST_URI'];
            $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        }

        private function getRoutes(){
            return Route::$routeList;
        }
        
        public function dispatchRoute(){
            $route = $this->routeLookup();
            if($route){
                $controllerName = str_replace('/','\\', $this->defaultControllerPath.$route->controller);
                
                $controllerPath = $this->defaultControllerPath.$route->controller.".php";
                if(file_exists($controllerPath)){
                    $controller = new $controllerName;
                    $controller->request = $_REQUEST;
                    if($this->params){
                        $controller->{$route->action}($this->params);
                    }else{
                        $controller->{$route->action}();
                    }

                    return;
                }
            }
            die('<h1>ROUTE NOT FOUND</h1>');
        }

        private function uriHasParams($routeUri){
            $pattern  = "/\{([^\)]+)\}/";
            $matches = [];
            $hasParams = preg_match($pattern, $routeUri, $matches);
            return $hasParams;
        }

        public function routeLookup(){
            $routes = $this->getRoutes();
            foreach($routes as $route){
                $routeUri = implode('/',[$route->prefix,trim($route->uri,'/')]);
                $uriMatch = false;
                if($this->uriHasParams($routeUri)){
                    $pattern = "/\{([^\)]+)\}/";
                    $paramsPattern = preg_replace($pattern, '(.*)', $routeUri);
                    $routePattern = str_replace("/", "\/", $paramsPattern);
                    $uriMatch = preg_match("/$routePattern/", $this->uriRequest, $params);
                    if(count($params) > 0){
                        $this->params = $params[1];
                    }
                }
                else{
                    $uriMatch = (strcasecmp($routeUri,$this->uriRequest) == 0 or strcasecmp($routeUri,$this->uriRequest.'/') == 0);
                }

                $methodMatch = $route->method == $this->requestMethod;

                if($uriMatch && $methodMatch){
                    return $route;
                }
            }
            return null;
        }

    }
}