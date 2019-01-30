<?php
namespace command;

use models\Post;
use models\Telegram;

class Parse
{
    /**
     * Публиковать ли просроченые посты
     * @var int
     */
    private $overdue = true;

    public function telegram(){
        $telegram = new Telegram();
        $update = json_decode($telegram->getUpdates(),true);

        exit();
    }
}