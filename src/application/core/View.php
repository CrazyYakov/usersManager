<?php

namespace core;

class View
{
    public static string $template_view = "template.php";

    public string $page = "document";

    function generate($content_view, $data = null)
    {
        if (Route::start()->getUrl() != "{$content_view}") {

            if (!empty($data)) {
                $methodGet = "?";
                foreach ($data as $key => $value) {
                    $methodGet .= "{$key}={$value}&";
                }
            }
            $url = "/{$content_view}" . ($methodGet ?? "");
            Route::start()->redirect($url);
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