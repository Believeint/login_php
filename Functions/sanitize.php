<?php

// Segurança ; Converter aspas simples/e ou duplas
function escape($string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8' );
}