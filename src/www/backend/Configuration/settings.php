<?php

return [
    'settings' => [

        // set to false in production
        'displayErrorDetails' => IS_DEVELOPMENT,

        'site' =>[
            'name'          => 'Some Name',
        ],

        // database settings
        'db' => [
            'driver'    => getenv('DATABASE_DRIVER'),
            'host'      => getenv('DATABASE_HOST'),
            'database'  => getenv('DATABASE_NAME'),
            'username'  => getenv('DATABASE_USERNAME'),
            'password'  => getenv('DATABASE_PASSWORD'),
            'charset'   => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci',
            'prefix'    => '',
        ],

        // template settings
        'view' => [
          'template_path' => __DIR__ . '/../Views',
          'twig' => [
            'cache' => FALSE,
            'debug' => IS_DEVELOPMENT,
          ],
        ],
    ],
];
