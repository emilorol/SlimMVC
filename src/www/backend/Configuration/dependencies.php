<?php

use Backend\Views\Factory;
use Backend\Controllers\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Pagination\Paginator;

$container = $app->getContainer();

$container['flash'] = function ($container) {
    return new \Slim\Flash\Messages;
};

LengthAwarePaginator::viewFactoryResolver(function () {
    return new Factory;
});

LengthAwarePaginator::defaultView('templates/base_pagination.twig');

Paginator::currentPathResolver(function () use ($container){
  $uri = $container->request->getUri();
  $query = preg_replace("/(\&page\=\d+|\?page\=\d+|page\=\d+)/i", "", $uri->getQuery());
  $query = (!empty($query)) ? '?'.$query : '';
  return  $uri->getPath() . $query;
});

Paginator::currentPageResolver(function () use ($container){
    return $container->request->getQueryParam('page', 1);
});

$container['db'] = function ($container) {
  $settings = $container->get('settings')['db'];
  $capsule = new Capsule;
  $capsule->addConnection($settings);
  $capsule->setAsGlobal();
  $capsule->bootEloquent();
  return $capsule;
};

$container['view'] = function ($container) {
  $site = $container->get('settings')['site'];
  $view = Factory::getEngine();
  $view->addExtension(new \Slim\Views\TwigExtension(
    $container->router,
    $container->request->getUri()
  ));

  $phone = new Twig_SimpleFilter('phone', function($input) {
    if (strlen($input) == 10)
    {
      return '(' . substr($input, 0, 3) . ') ' . substr($input, 3, 3) .'-'. substr($input, 6, 4);
    }
    else
    {
      return $input;
    }
  });

  $view->getEnvironment()->addFilter($phone);
  if (IS_DEVELOPMENT) { $view->addExtension(new Twig_Extension_Debug()); }
  $view->getEnvironment()->addGlobal('flash', $container->flash);
  $view->getEnvironment()->addGlobal('site', $site);
  return $view;
};

// Start session
new Session($container);
