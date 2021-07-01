<?php

namespace controllers;

use core\Controller;
use models\Department;


class DepartmentController extends Controller
{
    function actionIndex()
    {
        $department = new Department();
        $data = $department->get();
        $this->view->generate('departments/index', $data);
    }

    function actionCreate()
    {

    }
}