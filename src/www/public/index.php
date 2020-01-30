<?php

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;

/**
 * @file
 * The PHP page that serves all page requests on a your installation.
 */

// Include autoloader
require __DIR__.'/../vendor/autoload.php';

// Environment variables
$dotenv = (Dotenv::createImmutable(__DIR__ . '/../../config/'))->load();

// Set up constants
require __DIR__.'/../backend/Configuration/constants.php';

// Create container
$container = new League\Container\Container();
AppFactory::setContainer($container);

// Instantiate the app
$app = AppFactory::create();

// Settings for the app
require __DIR__.'/../backend/Configuration/settings.php';

// Set up dependencies
require __DIR__.'/../backend/Configuration/dependencies.php';

// Register middleware
require __DIR__.'/../backend/Configuration/middleware.php';

// Register routes
require __DIR__.'/../backend/Configuration/routes.php';

// Register controllers
require __DIR__.'/../backend/Configuration/controllers.php';

// Run app
$app->run();

