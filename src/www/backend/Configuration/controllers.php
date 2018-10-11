<?php

$container = $app->getContainer();

// Register controllers below
$container['Pages'] = function ($container) {
  return new \Backend\Controllers\Pages($container);
};
