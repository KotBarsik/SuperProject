<?php
/**
 * Created by PhpStorm.
 * User: salavat
 * Date: 30/01/2019
 * Time: 08:28
 */

namespace command;


class Sql
{
    public function dump(){
        echo system('mysqldump -uroot -h127.0.0.1 -pQwerty123 teme > teme.sql');
    }
}