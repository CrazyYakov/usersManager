<?php


namespace core;

use services\Validate;

class Request
{

    public $post;
    public $get;

    protected static Request $request;

    public static function initialization() : Request
    {
        if (!empty(self::$request)) {
            return self::$request;
        }

        self::$request = new self;
        self::$request->get();
        self::$request->post();
        return self::$request;
    }

    public function get($key = '')
    {
        if (!empty($key)) {
            if (is_array($_GET[$key])) {
                $array = Validate::secure($_GET[$key]);
                return filter_var_array($array, FILTER_SANITIZE_STRING);
            }else{
                return Validate::secure(filter_input(INPUT_GET, $key));
            }
        } else {
            $this->get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
            return filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        }
    }

    public function post($key = '')
    {
        if (!empty($key)) {

            if (is_array($_POST[$key])) {
                $array = Validate::secure($_POST[$key]);
                return filter_var_array($array, FILTER_SANITIZE_STRING);
            }else{
                return Validate::secure(filter_input(INPUT_POST, $key));
            }
        } else {
            $this->post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            return filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        }
    }
}