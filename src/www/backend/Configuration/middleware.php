<?php

use Slim\Middleware\ErrorMiddleware;
use Slim\Views\TwigMiddleware;

// CLI
// $app->add(new \pavlakis\cli\CliRequest());

$errorMiddleware = new ErrorMiddleware(
  $app->getCallableResolver(),
  $app->getResponseFactory(),
  IS_DEVELOPMENT,
  false,
  false
);

// $app->add($errorMiddleware);

// $twigMiddleware = new TwigMiddleware(
//     $container->get('view'),
//     $app->getRouteCollector()->getRouteParser(),
//     $app->getBasePath()
// );

// $app->add($twigMiddleware);
// $app->add(TwigMiddleware::createFromContainer($app));



// // Add Routing Middleware
// $app->addRoutingMiddleware();
