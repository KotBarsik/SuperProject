<?php
namespace command;

use models\Post;

class Postman
{
    public function send(){
        $post = new Post();
        $pending = $post->postByPending();

        foreach ($pending as $index=>$value){
            $map = [
                'messages' => $value['']
            ];
        }
        exit(time());
    }
}