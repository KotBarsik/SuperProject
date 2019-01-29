<?php
class autoloader{

    public static function load($className){
        $file = self::getFilePath($className);
        if(file_exists($file) AND is_readable($file)){
            require($file);
        }
        spl_autoload_unregister(array('autoloader', 'load'));
    }

    public static function migrations($className){
        $file = self::getFilePath($className);
        if(file_exists($file) AND is_readable($file)){
            require($file);
        }
        spl_autoload_unregister(array('autoloader', 'migration'));
    }

    public static function command($className){
        $file = self::getFilePath($className);
        if(file_exists($file) AND is_readable($file)){
            require($file);
        }
        spl_autoload_unregister(array('autoloader', 'command'));
    }

    public static function component($className){
        $file = self::getFilePath($className);
        if(file_exists($file) AND is_readable($file)){
            require($file);
        }
    }

    public static function model($className){
        $file = self::getFilePath($className);
        if(file_exists($file) AND is_readable($file)){
            require($file);
        }
    }

    protected static function getFilePath($className){
        return str_replace('\\','/',IndexPath.'/'.$className.'.php');
    }
}

spl_autoload_register(array('autoloader', 'component'));
spl_autoload_register(array('autoloader', 'model'));