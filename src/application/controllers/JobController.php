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
            'job' => $job->get(),
        ]);
    }
}