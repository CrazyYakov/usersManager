<?php


namespace core;


class Session
{

    use \traits\Helpers,
        \traits\Singleton;

    protected ?array $session;

    protected function __construct(?array $session = null)
    {
        $this->session = $session[0];
    }

    /**
     * @param $key
     * @param $value
     */
    public function setSession(array $session): void
    {
        $_SESSION = $this->transformInAssocArray($session);
    }

    public function getSession($key = '')
    {
        if (!empty($key)) {
            if ($key && isset($this->session)) {
                return $this->session[$key];
            }
            return null;
        }
        return $this->session ?? null;
    }

    public function unsetSession(): void
    {
        session_destroy();
    }

}