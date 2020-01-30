<?php

$container->add('settings', function () {
  return [
            // set to false in production
            'displayErrorDetails' => IS_DEVELOPMENT,

            'site' =>[
              'name'          => 'Slim MVC',
            ],

            // database settings
            // filter_input(INPUT_ENV, 'DATABASE_DRIVER', FILTER_SANITIZE_STRING)
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
          ];
});
