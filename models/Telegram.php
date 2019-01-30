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
            $this->sendMediaGroup($data);
        }
    }

    public function getUpdates(){
        $url = $this->url.$this->token.__FUNCTION__;

        return $this->http->send($url);
    }

    public function getFile($file_id){
        $url = $this->url.$this->token.__FUNCTION__;

        return $this->http->send($url,['file_id' => $file_id]);
    }

    private function sendMediaGroup($data){
        $build = [
            'chat_id' => $data['pubId'],
        ];

        $media = [];

        foreach ($data['img'] as $img){
            $picName = $this->createTmpFile($img['name'],base64_decode($img['data']));
            $media[] = [
                'type' => 'photo',
                'media' => 'attach://'.$picName['name'].'.'.$picName['format'],
                'caption' => ' '
            ];
            $media[] = [
                'type' => 'photo',
                'media' => 'attach://'.$picName['name'].'.'.$picName['format'],
                'caption' => ' '
            ];///new \CURLFile($picName['name'].'.'.$picName['format']);//'@'.$picName['name'].'.'.$picName['format'];///[] = curl_file_create($picName['name'].'.'.$picName['format'],$picName['mime'],$picName['name']);
        }

        $build['media'] = json_encode($media,JSON_UNESCAPED_SLASHES);

        $url = $this->url.$this->token.__FUNCTION__;

        $result = $this->http->send($url,$build);
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