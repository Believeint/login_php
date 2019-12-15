<?php


class Config
{
    // Retorna key da posição do Array Global Passada; ex: passe (mysql/host) para receber 127.0.0.1
    public static function get($path)
    {
        if($path) {
            $config = $GLOBALS['config'];
            $path = explode("/", $path);

            foreach ($path as $bit) {
                if(isset($config[$bit])){
                    $config = $config[$bit];
                }
            }
            return $config;
        }
        return false;
    }

}