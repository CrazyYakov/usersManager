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
        self::$request->setSession($session);
        return self::$request;
    }

    /**
     * @param array $session
     */
    public function setSession(?array $session): void
    {
        if ($session != null){
            array_push($this->session, $session);
            $_SESSION['session_login'] = $session['session_login'];
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