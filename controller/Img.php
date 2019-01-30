<?php

namespace controller;
use models\Post;
use models\Updates;

class Img
{
    public function get()
    {
        if(empty($_GET['type'])) {
            list($id, $index) = explode('|', $_GET['id']);

            $post = new Post();
            $data = $post->postById((int)$id);

            $img = json_decode($data['data'], true);

            if(isset($img[$index])){
                $this->renderImg($img[$index]);
            }
        }
        elseif($_GET['type'] == 'updates'){
            $post = new Updates();
            $data = $post->byId((int)$_GET['id']);

            $img = json_decode($data['data'], true);

            if(isset($img['file'])){
                $img['data'] = $img['file'];
                $this->renderImg($img);
            }
        }
    }

    public function renderImg($img){
        header( 'Content-Type: image/jpeg' );
        echo base64_decode($img['data']);
    }
}