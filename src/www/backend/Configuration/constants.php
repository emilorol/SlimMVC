<?php

date_default_timezone_set('America/New_York');

$dev_hosts = ['localhost', 'localhost:8080'];

define('IS_DEVELOPMENT', in_array($_SERVER['HTTP_HOST'], $dev_hosts));

define('REQUEST_TIME', (int) $_SERVER['REQUEST_TIME']);

define('IP_ADDRESS', $_SERVER['REMOTE_ADDR']);

if (IS_DEVELOPMENT)
{
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
}
