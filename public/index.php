<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Core\Session;
// $url = $_SERVER['REQUEST_URI'];
// $script_name = dirname($_SERVER['SCRIPT_NAME']);
// var_dump($script_name);
// $url = parse_url($url,PHP_URL_PATH);
// $url = trim($url, '/');
// var_dump($url);
Session::start();
$router = new Router();
$router->run();
