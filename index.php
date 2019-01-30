<?php
define('IndexPath',__DIR__);
require_once 'autoload.php';
spl_autoload_register(array('autoloader', 'load'));

$_GET['controller'] = isset($_GET['controller']) ? $_GET['controller'] : 'main';
$_GET['method'] = isset($_GET['method']) ? $_GET['method'] : 'main';

if($_GET['controller'] && $_GET['method']){
    $className = 'controller\\' . ucfirst($_GET['controller']);
    $method = $_GET['method'];
    $class = new $className;

    try {
        if (method_exists($class, $method)) {
            $class->{$method}();
        }
        else{
            throw new Exception('Страница не сущевствует');
        }
    }catch (Exception $exception){
        print_r($exception->getMessage());
    }
}