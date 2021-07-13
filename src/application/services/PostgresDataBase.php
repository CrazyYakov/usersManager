<?php

namespace services;

use PDO;

class PostgresDataBase
{
    private $dsn;
    private $username;
    private $password;

    private static PDO $instance;

    protected function __construct(array $config = [])
    {
        $this->dsn = $config['dsn'];
        $this->username = $config['username'];
        $this->password = $config['password'];
    }

    public static function getInstance(array $config = []) : PDO
    {
        if (!empty(self::$instance)) {
            return self::$instance;
        }

        $db = new self($config);
        self::$instance = $db->connect();
        return self::$instance;
    }

    protected function connect() : PDO
    {
        try {
            return (new PDO(
                $this->dsn,
                $this->username,
                $this->password,
                [
                    'charset' => 'UTF8'
                ]
            ));

        } catch (\PDOException $e) {
            print "error " . $e->getMessage();
            die();
        }
    }

    public function lastInsertID($name = null) : string
    {
        return self::getInstance()->lastInsertId($name);
    }

    public function errorCode()
    {
        return self::getInstance()->errorCode();
    }

    public function errorInfo()
    {
        return self::getInstance()->errorInfo();
    }
}