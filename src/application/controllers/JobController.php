<?php


namespace controllers;

use core\Controller;
use core\Request;
use models\Job;
use models\User;


class JobController extends Controller
{
    public function actionIndex()
    {
        $job = new Job();
        $this->view->generate('job/index', [
            'jobs' => $job->get(),
            'fields' => $job->getFields(),
        ]);
    }

    function actionCreate(Request $request)
    {
        $job = new Job();
        if ($request->post('submit') && $job->insert($request->post())) {
            $this->view->generate('job/view', [
                'id' => $job->id,
            ]);
        }

        $this->view->generate('job/create');
    }

    public function actionView(Request $request)
    {
        $job = new Job();
        $user = new User();
        $fields = $user->getFields();
        unset($fields[array_search('Профессия', $fields)]);
        $this->view->generate('job/view', [
            'job' => $job->get(['id' => $request->get['id']]),
            'data' => $user->getUsers(['job.id' => $job->id]),
            'fields' => $fields,
        ]);
    }

    public function actionUpdate(Request $request)
    {
        $job = new Job();

        if ($request->post('submit') && $job->update($request->post(), ['id' => $request->get['id']])) {
        $this->view->generate('job/view', [
            'id' => $job->id,
        ]);
    }
        $this->view->generate('job/update', [
            'job' => $job->get(['id' => $request->get['id']]),
        ]);
    }

    public function actionDelete(Request $request)
    {
        $job = new Job();

        if (strtolower($_SERVER['REQUEST_METHOD']) == strtolower('POST')) {
            $job->delete(['id' => $request->get['id']]);
        }
        $this->view->generate('job/index');
    }
}
