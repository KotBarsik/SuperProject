<?php
namespace component;

class httpRequest
{
    public $error;

    public $info;

    public function send($url,$data){
        $curl = curl_init($url);
        curl_setopt_array($curl, array(
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_POSTFIELDS => $data
        ));

        $result = curl_exec($curl);
        $this->info = curl_getinfo($curl);
        $this->error = curl_error($curl);

        return $result;
    }
}