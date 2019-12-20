<?php


class Hash
{

    public static function make($string, $salt = '') {
        return hash('sha256', $string . $salt);
    }

    public static function salt() {
        return hash('md5',rand(mt_rand(), 100));
    }


    public static function unique() {
        return self::make(uniqid());
    }

}