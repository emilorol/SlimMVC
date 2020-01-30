<?php

use Backend\Views\Factory;
use Slim\Views\TwigExtension;
use Backend\Controllers\Session;
use Slim\Psr7\Factory\UriFactory;
use Slim\Views\TwigRuntimeLoader;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Capsule\Manager as Capsule;

$container->add('uri', function() use ($container){
    return (new UriFactory())->createFromGlobals($_SERVER);
});

$container->add('flash', function() use ($container){
    return new \Slim\Flash\Messages;
});

LengthAwarePaginator::viewFactoryResolver(function () {
    return new Factory;
});

LengthAwarePaginator::defaultView('templates/base_pagination.twig');

Paginator::currentPathResolver(function () use ($container){
  $uri = $container->get('uri');
  $query = preg_replace("/(\&page\=\d+|\?page\=\d+|page\=\d+)/i", "", $uri->getQuery());
  $query = (!empty($query)) ? '?'.$query : '';
  return  $uri->getPath() . $query;
});

Paginator::currentPageResolver(function () use ($container){
    $page = 1;
    $uri = $container->get('uri')->getQuery();
    parse_str($container->get('uri')->getQuery(), $query);
    if (array_key_exists('page', $query)) {
      $page = (int) $query['page'];
    }
    return $page;
});

$container->add('db', function() use ($container) {
  $settings = $container->get('settings')['db'];
  $capsule = new Capsule;
  $capsule->addConnection($settings);
  $capsule->setAsGlobal();
  $capsule->bootEloquent();
  return $capsule;
});

$container->add('view', function () use ($container, $app) {
  $twig = Factory::getEngine();
  $twig->addRuntimeLoader(
    new TwigRuntimeLoader(
      $app->getRouteCollector()->getRouteParser(),
      $container->get('uri')
    )
  );

  $twig->addExtension(new TwigExtension());

  $phone = new Twig\TwigFilter('phone', function($input) {
    if (strlen($input) == 10) {
      return '(' . substr($input, 0, 3) . ') ' . substr($input, 3, 3) .'-'. substr($input, 6, 4);
    }
    else {
      return $input;
    }
  });

  $twig->getEnvironment()->addFilter($phone);
  if (IS_DEVELOPMENT) { $twig->addExtension(new \Twig\Extension\DebugExtension()); }
  $twig->getEnvironment()->addGlobal('flash', $container->get('flash'));
  $twig->getEnvironment()->addGlobal('site', $container->get('settings')['site']);
  return $twig;
});

// Start session
$container->add('session', function() use ($container) {
  return new Session($container);
});

$container->get('session');
