<?php

namespace core;

class View
{
    public static string $template_view = "template.php";

    public string $page = "Document";

    public Request $request;

    public Session $session;

    public Route $route;

    public function __construct()
    {
        $this->request = Request::getInstance();
        $this->session = Session::getInstance();
        $this->route = Route::getInstance();
    }

    function generate($content_view, $data = null)
    {

        if (!preg_match("/\//", $content_view)) {
            $urlPath = "{$content_view}/" . $this->route->getActionName();
        } else {
            $urlPath = $content_view;
        }
        if (
            ($this->route->getUrl() != $urlPath) && ($this->route->getUrl() != '/index')) {

            if (!empty($data)) {
                $methodGet = "?";
                foreach ($data as $key => $value) {
                    $methodGet .= "{$key}={$value}&";
                }
            }
            $url = "/{$content_view}" . ($methodGet ?? "");
            $this->route->redirect($url);
        }
        ob_start();
        if (is_array($data)) {
            extract($data);
        }
        include "application/views/{$content_view}.php";
        $content = ob_get_clean();
        include 'application/views/' . self::$template_view;
    }

}