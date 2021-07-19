<?php

namespace traits;


trait Helpers
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
        $url['path'] = trim($url['path'], "/");
        $routes['path'] = explode('/', $url['path']);

        if ($url['query']) {
            $routes['query'] = $_GET;
        }

        $routes['path']['controller'] = $routes['path'][0];
        unset($routes['path'][0]);
        if (isset($routes['path'][1])){
            $routes['path']['action'] = $routes['path'][1];
            unset($routes['path'][1]);
        }
        return $routes;
    }

    public function transformInAssocArray($var)
    {
        return (is_array($var)) ? array_map(array('self', 'transformInAssocArray'), $var) : $var;
    }

    public function validateInputKey($key, $request, $type, $options)
    {
        if (is_array($key)){
            $array = $this->transformInAssocArray($request[$key]);
            return filter_var_array($array, $options);
        }
        else{
            return $this->transformInAssocArray(filter_input($type, $key));
        }
    }
}