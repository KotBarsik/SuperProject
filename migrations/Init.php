<?php
namespace migrations;
use component\db;

class Init
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = db::connect();
    }

    public function up(){
        $this->posts();
        $this->users();
    }

    private function posts(){
        try {
            $result = $this->pdo->query("
              CREATE TABLE
                `posts` (
                    `id` INT(11) NOT NULL AUTO_INCREMENT,
                    `data` JSON NOT NULL,
                    `provider` CHARACTER(15) NOT NULL,
                    `status` CHARACTER(15) NOT NULL,
                    `uptime` TIMESTAMP,
                    `publish_time` TIMESTAMP,
                    PRIMARY KEY(`id`)
                )
            ");
        }catch (\Exception $e){
            print_r($e->getMessage());
        }
    }

    private function users(){
        try {
            $result = $this->pdo->query("
              CREATE TABLE
                `users` (
                    `id` INT(11) NOT NULL AUTO_INCREMENT,
                    `data` JSON NOT NULL,
                    `provider` CHARACTER(15) NOT NULL,
                    `uptime` TIMESTAMP,
                    `create_time` TIMESTAMP,
                    PRIMARY KEY(`id`)
                )
            ");
        }catch (\Exception $e){
            print_r($e->getMessage());
        }
    }
}