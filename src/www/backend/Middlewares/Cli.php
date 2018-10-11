<?php

namespace Backend\Middlewares;

class Cli extends Middleware
{
  public function __invoke($request, $response, $next)
  {

    if (!in_array(php_sapi_name(), ['cli']))
    {
        return $response->withStatus(403);
    }

    $response = $next($request, $response);

    return $response;
  }

}
