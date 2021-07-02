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
            'department' => $department->get(),
        ]);
    }

    function actionCreate()
    {

    }
}