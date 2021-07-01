<?php


namespace controllers;

use core\Controller;

class JobController extends Controller
{
    public function actionIndex()
    {
        $user = new Job();
        $data = $user->get();

        $this->view->generate('users/index', $data);
    }
}