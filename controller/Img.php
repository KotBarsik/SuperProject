<?php

namespace controller;
use models\Post;

class Img
{
    public function get()
    {
        list($id,$index) = explode('|',$_GET['id']);

        $post = new Post();
        $data = $post->postById((int)$id);

        $img = json_decode($data['data'],true);

        if(isset($img[$index])){
            $this->renderImg($img[$index]);
        }

    }

    public function renderImg($img){
        header( 'Content-Type: image/jpeg' );
        echo base64_decode($img['data']);
    }
}