<?php

namespace Backend\Views;

use \Slim\Views\Twig;

class Factory
{
    public static function getEngine()
    {
        return Twig::create(__DIR__ . '/../Views', [
              'cache' => FALSE,
              'debug' => IS_DEVELOPMENT,
        ]);
    }

    public function make($view, $data = [])
    {
        return static::getEngine()->fetch($view, $data);
    }
}
