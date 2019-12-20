<?php


class Usuario
{
    private $_db;


    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('usuarios', $fields)) {
            throw new Exception('Não foi possivel registrar um novo usuário');
        }
    }

}