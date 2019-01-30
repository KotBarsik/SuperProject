<?php
namespace models;

use component\httpRequest;

class Telegram
{
    private $url = 'https://api.telegram.org/';
    private $token = 'bot677164682:AAG-muRn12opu6Pkg2UddXKJogwZLTu0uXc/';

    /**
     * @var httpRequest
     */
    private $http;

    public function __construct()
    {
        $this->http = new httpRequest();
    }

    public function messages($data){
        if(count($data['img']) >= 1){
            return $this->sendPhoto($data);
        }
        else{
            return $this->sendMessage($data);
        }
    }

    public function getUpdates(){
        $url = $this->url.$this->token.__FUNCTION__;

        return $this->http->send($url);
    }

    public function getFile($file_id){
        $url = $this->url.$this->token.__FUNCTION__;

        $result = json_decode($this->http->send($url,['file_id' => $file_id]),true);
        if($result['result']){
            $url = $this->url.'file/'.$this->token.$result['result']['file_path'];
            $result = base64_encode(file_get_contents($url));
            return $result;
        }

        return null;
    }

    private function sendPhoto($data){
        $build = [
            'caption' => $data['message'],
            'chat_id' => $data['pubId'],
        ];

        foreach ($data['img'] as $img){
            $picName = $this->createTmpFile($img['name'],base64_decode($img['data']));
            $build['photo'] = new \CURLFile($picName['name'].'.'.$picName['format']);
        }

        $tmpPic = $build['photo']->name;

        $url = $this->url.$this->token.__FUNCTION__;

        $result = $this->http->send($url,$build);

        unlink($tmpPic);

        return $result;
    }

    private function sendMessage($data){
        $build = [
            'text' => $data['message'],
            'chat_id' => $data['pubId'],
        ];

        $url = $this->url.$this->token.__FUNCTION__;

        $result = $this->http->send($url,$build);

        return $result;
    }

    public function createTmpFile($name,$pic){
        file_put_contents($name,$pic);
        $picData = getimagesize($name);
        $picData['format'] = str_replace('image/','',$picData['mime']);
        $picData['name'] = $name;
        rename($name,$name.'.'.$picData['format']);
        return $picData;
    }
}