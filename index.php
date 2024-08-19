<?php

defined('ROOT_PATH') or define('ROOT_PATH', dirname(__FILE__));
defined('COMMON_PATH') or define('COMMON_PATH', dirname(__FILE__) . '/common');

require_once COMMON_PATH . '/tools/functions.php';
require_once ROOT_PATH . '/vendor/autoload.php';

/*error_reporting('display_errors', 'on');
error_reporting(E_ALL);
echo $b;*/

header('Access-Control-Allow-Origin:*');
header("Content-Type:text/html;charset=utf-8");

$controller = ucfirst(strtolower($_GET['c'] ?? "Test")) . 'Controller';
$action     = strtolower($_GET['a'] ?? "index");

spl_autoload_register(function ($className) {
    $file = str_replace('\\', '/', $className) . '.php';
    if (file_exists($file)) {
        include $file;
    }
});

$dynCOntroller = "\\controllers\\" . $controller;
(new $dynCOntroller())->$action();