<?php

return [
    'database' => [
        'dsn' => 'pgsql:dbname=barbotdb;host=postgres;port=5432',
        'username' => 'barbot',
        'password' => 'secret',
    ],
    'application' => [
        'controllers' => [
            'UserController',
            'DepartmentController',
            'SiteController',
            'JobController',
            'AuthController'
        ],
        'models' => [
            'User',
            'Department',
            'Job',
        ],
        'core' => [
            'Controller',
            'Model',
            'View',
            'Route',
            'Repository',
            'Request',
        ],
        'services' =>[
            'PostgresDataBase',
            'Validate',
            'Session'
        ],

    ]
];