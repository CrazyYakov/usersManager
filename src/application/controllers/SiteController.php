<?php


namespace controllers;

use core\Controller;


class SiteController extends Controller
{
    public function actionIndex()
    {
//        session_start();
//        if (!isset($_SESSION['count'])) {
//            $_SESSION['count'] = 0;
//        }
//        $_SESSION['count']++;
//
//        $redis = new \Redis();
//        $redis->connect('redis', 6379);
//        var_dump($redis->keys("*"));
//        var_dump($redis->get('PHPREDIS_SESSION:e1781e4b9d5fbf71a06a2c482f2beebf'));
        $this->view->generate('site');
    }
}