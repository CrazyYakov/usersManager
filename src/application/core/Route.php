<?php

namespace core;

use services\Validate;

class Route
{

    protected string $controllerName = "controllers\\SiteController";
    protected string $actionName = 'actionIndex';
    protected string $url;

    protected static Route $route;

    public static function start(): Route
    {
        if (!empty(self::$route)) {
            return self::$route;
        }

        $route = new self;
        $routes =  Validate::getParseUrl($_SERVER['REQUEST_URI']);
        $route->setControllerAction($routes['path']);
        $route->url = "{$routes['path'][1]}/" . (!empty($routes['path'][2]) ? $routes['path'][2] : "index");
        self::$route = $route;
        return self::$route;
    }

    public function run()
    {

        try {
            $controller = $this->controllerName;
            $action = $this->actionName;

            if (!class_exists($controller)) {
                throw new \Exception();
            }
            (new $controller)->$action();
        } catch (\Exception $e) {
            Route::errorPage404();
            die();
        }
    }

    protected function setControllerAction($routes)
    {
        // получаем имя контроллера
        if (!empty($routes[1])) {
            $controller_name = ucfirst($routes[1]);
            $this->controllerName = "controllers\\{$controller_name}Controller";
        }

        // получаем имя экшена
        if (!empty($routes[2])) {
            $action_name = ucfirst($routes[2]);
            $this->actionName = "action{$action_name}";
        }
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function redirect(string $url)
    {
        $location = "Location: $url";
        header($location);
//        $route = self::$route;
//        $routes = $route->getPathUrl($url);
//        $route->setControllerAction($routes);
//        return $route;
    }

    private static function errorPage404()
    {
        $host = $_SERVER['HTTP_HOST'] . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }


}