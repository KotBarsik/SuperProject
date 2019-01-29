<?php
/**
 * Created by PhpStorm.
 * User: salavat
 * Date: 30/01/2019
 * Time: 03:03
 */

namespace models;


use component\httpRequest;

class Telegram
{
    private $http;

    public function __construct()
    {
        $this->http = new httpRequest();
    }

    public function messages(){

    }
}