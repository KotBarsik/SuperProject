<?php
namespace component;

class db
{
    private static $connect = null;

    public static function connect(){
        if(is_null(self::$connect)){
            try {
                $db = new \PDO("mysql:host=db;dbname=teme", 'root', 'Qwerty123');
                $db->exec("set names utf8");
                self::$connect = $db;
                return self::$connect;
            }catch (\Exception $exception){
                print_r($exception->getMessage());
            }
        }
        else{
            return self::$connect;
        }
    }
}