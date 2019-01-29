<?php
define('IndexPath',__DIR__);
require_once 'autoload.php';

if($_SERVER['argv']){
    if(count($_SERVER['argv']) >= 2 ){
        $argv = $_SERVER['argv'];
        if($argv[1] != 'migration') {
            spl_autoload_register(array('autoloader', 'command'));
            $className = 'command\\' . ucfirst($argv[1]);
            $method = $argv[2];
            for ($i=2;$i >= 0;$i--){
                unset($argv[$i]);
            }
        }
        else{
            spl_autoload_register(array('autoloader', 'migrations'));
            $className = 'migrations\\' . ucfirst($argv[2]);
            $method = $argv[3];
            for ($i=3;$i >= 0;$i--){
                unset($argv[$i]);
            }
        }

        $class = new $className();
        if (method_exists($class, $method)) {
            $class->{$method}(array_values($argv));
        }
    }
}