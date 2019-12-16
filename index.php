<?php

require_once 'Core/init.php';

$user = DB::getInstance()->get('usuarios', array('nome_usuario', '=', 'elias'));

if(!$user->count()) {
    echo 'No User;';
} else {
    echo 'Ok!';
}

var_dump($user->count());




