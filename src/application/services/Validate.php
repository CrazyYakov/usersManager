<?php


namespace services;


class Validate
{
    public static function isCorrectFields($tableFields, $postFields)
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

//        if ($url['query']) {
//            foreach (explode('&', $url['query']) as $varGet) {
//                list($key, $value) = explode('=', $varGet);
//                $routes['query'][$key] = $value;
//            }
//        }

        return $routes;

    }
}