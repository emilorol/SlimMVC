<?php

declare(strict_types=1);

$container->add('Pages', function () use ($container) {
  return new \Backend\Controllers\Pages($container);
});
