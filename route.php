<?php
namespace cbulock\me;

require_once('vendor/autoload.php');

$route = json_decode(file_get_contents('route.json'));

$route = new \cbulock\Simple\Router($_SERVER['REQUEST_URI'], $route, '\cbulock\me\controller\\');
$route->get();