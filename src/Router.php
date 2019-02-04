<?php
namespace Framework;
    class Router
    {
        protected $routes;

        public function __construct($routes){
            $this->routes = $routes;
        }

        public function match($url)
        {
            if (isset($this->routes[$url])) {
                $this->initialize($url, $this->routes);
                return true;//static route found
            } else {
                if (preg_match('/\d+/', $url, $id)) {
                    $array = explode("/", $url);
                    $array[2] = "{" . "id" . "}";
                    $url = implode("/", $array);
                    if (isset($this->routes[$url])) {
                        $this->initialize($url, $this->routes);
                        return true;//dynamic route found
                    }
                } else {
                    echo "Route doesn't exist";
                    return false;
                }
            }
        }

        public function initialize($url)
        {
            $controller = $this->routes[$url]["controller"];
            $controllername= "App\\Controllers\\" . $controller;
            $controllerObject = new $controllername;
            $action = $this->routes[$url]["action"];
            $controllerObject->{$action}();
        }
}