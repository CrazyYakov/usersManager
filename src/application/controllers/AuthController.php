<?php


namespace controllers;

use core\Controller;
use core\Request;
use services\Session;

class AuthController extends Controller
{
    public function actionLogin(Request $request, Session $session)
    {
        var_dump($session->getSession());
        $data = ['login' => 'root', 'password' => '1234'];

        if (($data['login'] == $request->post('login')) && ($data['password'] == $request->post('password'))) {
            $_SESSION['session_login'] = 1;
            var_dump($_SESSION);
            $session->setSession('session_login', '1');
            $this->view->generate('site');
        }

        $this->view->generate('auth/login');
    }
}