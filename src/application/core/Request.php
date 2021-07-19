<?php


namespace core;


class Request
{

    use \traits\Helpers,
        \traits\Singleton;

    public $post;
    public $get;


    public function __construct()
    {
        $this->get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $this->post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    }

    public function get($key = '')
    {
        if (!empty($key)) {
            return $this->validateInputKey($key, $_GET, INPUT_GET, FILTER_SANITIZE_STRING);
        } else {
            return $this->get;
        }
    }

    public function post($key = '')
    {
        if (!empty($key)) {
            return $this->validateInputKey($key, $_POST, INPUT_POST, FILTER_SANITIZE_STRING);
        } else {
            return $this->post;
        }
    }
}
