<?php
namespace command;

use models\Post;
use models\Telegram;

class Postman
{
    /**
     * Публиковать ли просроченые посты
     * @var int
     */
    private $overdue = true;

    public function send(){
        $post = new Post();
        $pending = $post->postByPending();

        $telegram = new Telegram();

        foreach ($pending as $index=>$value){
            $send = false;

            //Самая мощьная проверка врмени публикации :)
            $serverTime = (int)preg_replace('/[^0-9]+/ui','',date('Y-m-d H:s',time()));
            $publishTime = (int)preg_replace('/[^0-9]+/ui','',preg_replace('/:[0-9]+$/ui','',$value['publish_time']));
            //СРавнение придуманое в 4 часа утра
            if($serverTime >= $publishTime){
                if($serverTime == $publishTime){
                    $send = true;
                }
                elseif ($this->overdue){
                    //Публикация просроченых по времени постов
                    $send = true;
                }
            }

            if($send) {
                $map = [
                    'img' => json_decode($value['data'], true),
                    'provider' => $value['provider'],
                    'message' => $value['message'],
                    'pubId' => $value['pubId'],
                    'publish_time' => $value['publish_time']
                ];

                ${$value['provider']}->messages($map);
            }
        }
    }
}