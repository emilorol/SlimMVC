<?php

/**
 * @file
 * The PHP page that serves all page requests on a your installation.
 */

// Include autoloader
require __DIR__ . '/../vendor/autoload.php';

// Environment variables
$dotenv = (new \Dotenv\Dotenv(__DIR__ . '/../../config/'))->load();

// Set up constants
require __DIR__ . '/../backend/Configuration/constants.php';

// Instantiate the app
$settings = require __DIR__ . '/../backend/Configuration/settings.php';

$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../backend/Configuration/dependencies.php';

// Register middleware
require __DIR__ . '/../backend/Configuration/middleware.php';

// Register routes
require __DIR__ . '/../backend/Configuration/routes.php';

// Register controllers
require __DIR__ . '/../backend/Configuration/controllers.php';

// Run app
$app->run();

