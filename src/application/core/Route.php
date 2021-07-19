<?php

namespace core;

use Exception;


class Route
{
    use \traits\Helpers,
        \traits\Singleton;

    protected string $controllerName = "controllers\\SiteController";
    protected string $actionName = 'actionIndex';
    protected string $url;

    public ?Request $request;
    public ?Session $session;

    protected function __construct($params)
    {
        $routes = $this->getParseUrl(filter_var($_SERVER['REQUEST_URI']));
        $this->setControllerAction($routes);
        $this->request = $params[0]['request'] ?? null;
        $this->session = $params[0]['session'] ?? null;
    }

    public function run()
    {
        try {
            if ($this->session->getSession() == null) {
                $this->setControllerAction(['controller' => 'Auth', 'action' => 'login']);
            }

            $controller = $this->controllerName;
            $action = $this->actionName;
            if (!class_exists($controller) || !method_exists($controller, $action)) {
                throw new Exception("not Found 404");
            }
            (new $controller)->$action($this->request, $this->session);

        } catch (Exception $e) {
            echo $e->getMessage();
            Route::errorPage404();
        }
    }

    protected function setControllerAction(array $routes)
    {
        $route_path = $routes['path'] ?? $routes;

        if (!empty($controller_name = ucfirst($route_path['controller']))) {
            $this->controllerName = "controllers\\{$controller_name}Controller";
        }
        if (!empty($action_name = ucfirst($route_path['action']))) {
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

    public function getActionName(): string
    {
        return strtolower(preg_replace('/action/', '', $this->actionName));
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