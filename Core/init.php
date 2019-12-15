<?php

session_start();

// Variáveis de configuração
$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => 'adm371',
        'db' => 'login01'
    ),
    'lembrar_me' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user'
    )
);

// AutoLoader de Classes
spl_autoload_register(function ($class) {
    require_once 'Model/' . $class . '.php';
});

require_once 'Functions/sanitize.php';

