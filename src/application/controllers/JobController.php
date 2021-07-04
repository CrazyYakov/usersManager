<?php


namespace controllers;

use core\Controller;
use models\Job;


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

    function actionCreate()
    {
        $job = new Job();
        if ($_POST['submit'] && $job->insert($_POST)) {
            $this->view->generate('job/view', [
                'job' => $job->get($_GET['id']),
            ]);
        }

        $this->view->generate('job/create');
    }

    public function actionView()
    {
        $job = new Job();
        $this->view->generate('job/view', [
            'job' => $job->get($_GET['id']),
        ]);
    }

    public function actionUpdate()
    {
        $job = new Job();

        if ($_POST['submit'] && $job->update($_POST, $_GET['id'])) {

            $this->view->generate('job/view', [
                'id' => $job->id,
            ]);
        }

        $this->view->generate('job/update', [
            'job'  => $job->get($_GET['id']),
        ]);
    }

    public function actionDelete()
    {
        $job = new Job();
        $job->delete($_GET['id']);
        $this->view->generate('job/index');
    }
}
