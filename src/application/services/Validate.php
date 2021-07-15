<?php


namespace services;


class Validate
{
    public static function hastFields(?array $tableFields, ?array $postFields)
    {
        $keyFieldPost = array_keys($postFields);
        $result = array_diff($tableFields, $keyFieldPost);
        if (empty($result)) {
            return true;
        }
        return false;
    }

    public static function getParseUrl(string $url): array
    {
        $routes = [];
        $url = parse_url($url);
        $routes['path'] = explode('/', $url['path']);

        if ($url['query']) {
            $routes['query'] = $_GET;
        }
        return $routes;
    }

    public static function secure($var)
    {
        return (is_array($var)) ? array_map(array('self', 'secure'), $var) :
            htmlspecialchars($var, ENT_COMPAT);
    }
}