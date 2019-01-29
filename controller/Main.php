<?php
namespace controller;
use models\Post;

class Main
{
    public function telegram(){
        $post = new Post();
        $status = $post->byPostTelegram('sending');
        exit('hi');
    }

    public function add(){
        echo 'Добавить пост??';
    }
}