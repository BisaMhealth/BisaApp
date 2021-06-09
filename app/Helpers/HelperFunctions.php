<?php
namespace App\Helpers;

class HelperFunctions
{
    public function getBaseUrl(){
        if(isset($_SERVER['HTTPS'])){
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        }
        else{
            $protocol = 'http';
        }
        return $protocol . "://" . parse_url($_SERVER['REQUEST_URI'], PHP_URL_HOST).$_SERVER['SERVER_NAME']."/bisa";
    }
}
