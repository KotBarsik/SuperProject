<?php

namespace controller;

use component\view;
use models\Post;

class Main
{
    protected $provider = ['telegram', 'facebook'];

    public function main(){
        $post = new Post();
        $status = $post->allPosts();
        $view = new view();
        $view->render('index',$status);
    }

    public function telegram()
    {
        $post = new Post();
        $status = $post->byPostTelegram('sending');
        exit('hi');
    }

    public function add()
    {
        if (empty($_POST)) {
            $view = new view();
            $view->render('add');
        } else {
            $data = [];
            if (isset($_FILES['pic'])) {
                foreach ($_FILES['pic']['tmp_name'] as $key => $img) {
                    $admitted = ['image/png', 'image/jpg', 'image/jpeg'];
                    $imgInfo = getimagesize($img);
                    if (is_numeric(array_search($imgInfo['mime'], $admitted))) {
                        $data['img'][$key]['name'] = md5(microtime() . ' ' . +rand(1111111, 999999999));
                        $data['img'][$key]['data'] = base64_encode(file_get_contents($img));
                    }
                }
            }
            $data['time'] = isset($_POST['time']) ? $_POST['time'] : null;
            $data['type'] = isset($_POST['type']) ? $_POST['type'] : null;
            $data['message'] = isset($_POST['desc']) ? $_POST['desc'] : null;
            $data['time'] = isset($_POST['time']) ? $_POST['time'] : null;
            $data['status'] = 'pending';
            $post = new Post();
            $post->savePost($data);
        }
    }
}