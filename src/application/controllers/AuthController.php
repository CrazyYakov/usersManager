<?php


namespace controllers;

use core\Controller;
use core\Request;
use core\Session;


class AuthController extends Controller
{
    public function actionLogin(Request $request, Session $session)
    {
        if ($session->getSession('session_login') != null) {
            $this->view->generate('site');
        }

        $data = ['login' => 'root', 'password' => '1234'];

        if (($data['login'] == $request->post('login')) && ($data['password'] == $request->post('password'))) {

            $session->setSession(['session_login' => '1']);
            $this->view->generate('site');
        }

        $this->view->generate('auth/login');
    }

    public function actionOut(Request $request, Session $session)
    {
        $session->unsetSession();
        $this->view->generate('auth/login');
    }
}