<?php

namespace controllers;

use core\Controller;
use models\Department;
use models\Job;
use models\User;


class UserController extends Controller
{

    public function actionIndex()
    {
        $user = new User();
        $this->view->generate('user/index', [
            'data' => $user->getAll(),
            'fields' => $user->getFields()
        ]);
    }

    public function actionView()
    {
        $user = new User();
        $this->view->generate('user/view', [
            'user' => $user->getUser($_GET['id']),
        ]);
    }

    public function actionCreate()
    {
        $user = new User();
        if ($_POST['submit'] && $user->insert($_POST)) {
            $this->view->generate('user/view', [
                'id' => $user->id,
            ]);
        }
        $this->view->generate('user/create', [
            'departments' => (new Department())->get(),
            'jobs' => (new Job())->get(),
        ]);
    }

    public function actionDelete()
    {
        $user = new User();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user->deleteUser(['id' => $_GET['id']]);
        }
        $this->view->generate('user/index');
    }

    public function actionUpdate()
    {
        $user = new User();

        if ($_POST['submit'] && $user->update($_POST, ['id' => $_GET['id']])) {

            $this->view->generate('user/view', [
                'id' => $user->id,
            ]);
        }

        $this->view->generate('user/update', [
            'user' => $user->get(['id' => $_GET['id']]),
            'departments' => (new Department())->get(),
            'jobs' => (new Job())->get(),
        ]);
    }
}
