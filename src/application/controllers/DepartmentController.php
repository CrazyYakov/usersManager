<?php

namespace controllers;

use core\Controller;
use core\Request;
use models\Department;
use models\User;


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

    function actionCreate(Request $request)
    {
        $department = new Department();
        if ($request->post('submit') && $department->insert($request->post())) {
            $this->view->generate('department/view', [
                'id' => $department->id,
            ]);
        }

        $this->view->generate('department/create');
    }

    public function actionView(Request $request)
    {
        $user = new User();
        $department = new Department();
        $dataDepartment = $department->get(['id' => $request->get('id')]);
        $dataUser = $user->getUsers(['department.id' => $department->id]);
        $fields = $user->getFields();
        unset($fields[array_search('Департамент', $fields)]);
        $this->view->generate('department/view', [
            'department' => $dataDepartment,
            'data' => $dataUser,
            'fields' => $fields,
        ]);
    }

    public function actionUpdate(Request $request)
    {
        $department = new Department();

        if ($request->post('submit') && $department->update($request->post(), ['id' => $request->get('id')])) {

            $this->view->generate('department/view', [
                'id' => $department->id,
            ]);
        }

        $this->view->generate('department/update', [
            'department' => $department->get(['id' => $request->get('id')]),
        ]);
    }

    public function actionDelete(Request $request)
    {
        $department = new Department();

        if (strtolower($_SERVER['REQUEST_METHOD']) == strtolower('POST')) {
            $department->delete(['id' => $request->get('id')]);
        }

        $this->view->generate('department/index');
    }

}