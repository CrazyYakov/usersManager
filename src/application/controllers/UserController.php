<?php

namespace controllers;

use core\Controller;
use core\Request;
use models\Department;
use models\Job;
use models\User;


class UserController extends Controller
{

    public function actionIndex()
    {
//        $filter = [];
        $user = new User();
        $this->view->generate('user/index', [
            'data' => $user->getUsers(),
            'fields' => $user->getFields()
        ]);
    }

    public function actionCreate(Request $request)
    {
        $user = new User();

        if ($request->post('submit') && $user->insert($request->post)) {
            $this->view->generate('user/view', [
                'id' => $user->id,
            ]);
        }

        $this->view->generate('user/create', [
            'departments' => (new Department())->get(),
            'jobs' => (new Job())->get(),
        ]);
    }

    public function actionView(Request $request)
    {
        $user = new User();
        $this->view->generate('user/view', [
            'user' => $user->getUsers(['users.id' => $request->get('id')]),
        ]);
    }

    public function actionDelete(Request $request)
    {
        $user = new User();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user->delete(['id' => $request->get('id')]);
        }
        $this->view->generate('user/index');
    }

    public function actionUpdate(Request $request)
    {
        $user = new User();

        if ($request->post('submit') && $user->update($request->post(), ['id' => $request->get('id')])) {
            $this->view->generate('user/view', [
                'id' => $user->id,
            ]);
        }

        $this->view->generate('user/update', [
            'user' => $user->get(['id' => $request->get('id')]),
            'departments' => (new Department())->get(),
            'jobs' => (new Job())->get(),
        ]);
    }
}
