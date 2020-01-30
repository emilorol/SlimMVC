<?php

namespace Backend\Controllers;

use League\Container\Container;

class Controller
{
  protected $container;

  public function __construct(Container $container)
  {
    $this->container = $container;
  }

  public function __get($property)
  {
    if ($this->container->get($property))
    {
      return $this->container->get($property);
    }
  }
}
