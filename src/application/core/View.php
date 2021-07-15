<?php

namespace core;

class View
{
    public static string $template_view = "template.php";

    public string $page = "Document";

    function generate($content_view, $data = null)
    {

        if (!preg_match("/\//", $content_view)) {
            $urlPath = "{$content_view}/" . Route::getRoute()->getActionName();
        } else {
            $urlPath = $content_view;
        }
        if (
            (Route::getRoute()->getUrl() != $urlPath) && (Route::getRoute()->getUrl() != '/index')) {

            if (!empty($data)) {
                $methodGet = "?";
                foreach ($data as $key => $value) {
                    $methodGet .= "{$key}={$value}&";
                }
            }
            $url = "/{$content_view}" . ($methodGet ?? "");
            Route::getRoute()->redirect($url);
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