<?php


namespace controllers;

use core\Controller;
use core\Request;
use services\Session;

class AuthController extends Controller
{
    public function actionLogin(Request $request, Session $session)
    {
        $data = ['login' => 'root', 'password' => '1234'];

        if (($data['login'] == $request->post('login')) && ($data['password'] == $request->post('password'))) {
            $session->setSession(['session_login'=>'ok']);
            $this->view->generate('site');
        }

        $this->view->generate('auth/login', [
            'session_login' => $session->getSession('login'),
        ]);
    }
}