<?php

namespace Backend\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Pages extends Controller
{
  public function index(Request $request, Response $response)
  {
    $data['page_title'] = 'Welcome';
    return $this->view->render($response, 'pages/index.twig', $data);
  }
}
