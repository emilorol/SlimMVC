<?php

namespace Backend\Views;

class Factory
{
    protected $view;

    public static function getEngine()
    {
        return new \Slim\Views\Twig(__DIR__ . '/../Views', [
              'cache' => false,
              'debug' => IS_DEVELOPMENT,
        ]);
    }

    public function make($view, $data = [])
    {
        $this->view = static::getEngine()->fetch($view, $data);

        return $this;
    }

    public function render()
    {
        return $this->view;
    }
}
