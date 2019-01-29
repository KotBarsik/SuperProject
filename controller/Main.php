<?php
namespace controller;
use component\view;
use models\Post;

class Main
{
    public function telegram(){
        $post = new Post();
        $status = $post->byPostTelegram('sending');
        exit('hi');
    }

    public function add(){
        $view = new view();
        $view->render('add',array(['d']));
    }
}