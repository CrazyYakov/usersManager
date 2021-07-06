<?php

namespace controllers;

use core\Controller;
use models\Department;


class DepartmentController extends Controller
{
    function actionIndex()
    {
        $department = new Department();

        $this->view->generate('department/index', [
            'departments' => $department->get(),
            'fields' => $department->getFields()
        ]);
    }

    function actionCreate()
    {
        $department = new Department();
        if ($_POST['submit'] && $department->insert($_POST)) {
            $this->view->generate('department/view', [
                'id' => $department->id,
            ]);
        }

        $this->view->generate('department/create');
    }

    public function actionView()
    {
        $department = new Department();
        $this->view->generate('department/view', [
            'department' => $department->get(['id' => $_GET['id']]),
        ]);
    }

    public function actionUpdate()
    {
        $department = new Department();

        if ($_POST['submit'] && $department->update($_POST, ['id' => $_GET['id']])) {

            $this->view->generate('department/view', [
                'id' => $department->id,
            ]);
        }

        $this->view->generate('department/update', [
            'department' => $department->get(['id' => $_GET['id']]),
        ]);
    }

    public function actionDelete()
    {
        $department = new Department();

        if (strtolower($_SERVER['REQUEST_METHOD']) == strtolower('POST')) {
            $department->delete(['id' => $_GET['id']]);
        }

        $this->view->generate('department/index');
    }

}