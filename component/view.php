<?php
/**
 * Created by PhpStorm.
 * User: salavat
 * Date: 29/01/2019
 * Time: 17:44
 */

namespace component;


class view
{
    protected $viewPath = IndexPath.'/view/';

    public function render($view,$data){
        $this->head();
        $this->load($view,$data);
        $this->footer();
    }

    protected function head(){
        $this->load('header');
    }

    protected function footer(){
        $this->load('footer');
    }

    protected function load($view,$data = []){
        $file = $this->viewPath.$view.'.php';
        if(file_exists($file)){
            require_once $file;
        }
        else{
            throw new \Exception('Шаблон не найден: '.$view);
        }
    }
}