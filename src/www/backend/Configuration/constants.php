<?php

date_default_timezone_set('America/New_York');

$dev_hosts = ['www.slim-mvc.com', 'www.slim-mvc.com:9035'];

$http_host = filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_STRING);
define('IS_DEVELOPMENT', in_array(isset($http_host) ? $http_host : 'localhost', $dev_hosts) ? TRUE : FALSE);

$request_time = filter_input(INPUT_SERVER, 'REQUEST_TIME', FILTER_VALIDATE_INT);
define('REQUEST_TIME', (int) $request_time);

$remote_addr = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP);
define('IP_ADDRESS', isset($remote_addr) ? $remote_addr : '127.0.1.1');

if (IS_DEVELOPMENT)
{
  error_reporting(E_ALL);
  ini_set('display_errors', "on");
}
