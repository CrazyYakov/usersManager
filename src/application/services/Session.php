<?php


namespace services;


class Session
{
    public array $session = [];

    protected static Session $request;

    public static function initialization(?array $session = []): Session
    {
        if (!empty(self::$request)) {
            return self::$request;
        }
        self::$request = new self;
        if ($session != null){
            self::$request->$session[] = $session;
        }
        return self::$request;
    }

    /**
     * @param $key
     * @param $value
     */
    public function setSession($key, $value): void
    {
        $log = $key;
        $_SESSION['session_login'] = $value;
        if ($value != null && $key != null){
            $this->session[$key] = $value;
        }
    }

    /**
     * @return array
     */
    public function getSession(): ?array
    {
        return $this->session;
    }
}