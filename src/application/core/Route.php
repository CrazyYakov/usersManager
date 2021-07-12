<?php

namespace core;

use services\Validate;


class Route
{

    protected string $controllerName = "controllers\\SiteController";
    protected string $actionName = 'actionIndex';
    protected string $url;

    protected static Route $route;
    public Request $request;

    public static function start(Request $request): Route
    {
        if (!empty(self::$route)) {
            return self::$route;
        }

        $route = new self;
        $routes = Validate::getParseUrl(filter_var($_SERVER['REQUEST_URI']), FILTER_SANITIZE_ENCODED);
        $route->setControllerAction($routes);
        $route->request = $request;
        self::$route = $route;
        return self::$route;
    }

    public function run()
    {

        try {
            $controller = $this->controllerName;
            $action = $this->actionName;
            if (!class_exists($controller) || !method_exists($controller, $action)) {
                throw new \Exception();
            }
            (new $controller)->$action($this->request);
        } catch (\Exception $e) {
            Route::errorPage404();
            die();
        }
    }

    protected function setControllerAction($routes)
    {
        $controller_name = "";
        $route_path = $routes['path'];
        // получаем имя контроллера
        if (!empty($route_path[1])) {
            $controller_name = ucfirst($route_path[1]);
            $this->controllerName = "controllers\\{$controller_name}Controller";
        }
        $action_name = "";
        // получаем имя экшена
        if (!empty($route_path[2])) {
            $action_name = ucfirst($route_path[2]);
            $this->actionName = "action{$action_name}";
        } else {
            $route_query = $routes['query'];
            if (is_array($route_query) && key_exists('action', $route_query)) {
                $action_name = ucfirst($route_query['action']);
                $this->actionName = "action{$action_name}";
            }
        }

        $url = strtolower("$controller_name/" . (!empty($action_name) ? $action_name : "index"));
        $this->setUrl($url);
    }

    protected function setUrl(string $url): void
    {
        $this->url = $url;
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