<?php


class Usuario
{
    private $_db;
    private  $_data;
    private $_sessionName;


    public function __construct()
    {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('usuarios', $fields)) {
            throw new Exception('Não foi possivel registrar um novo usuário');
        }
    }

    public function find($usuario = null) {
        if($usuario) {
            $field = (is_numeric($usuario)) ? 'id' : 'nome_usuario';
            $data = $this->_db->get('usuarios', array($field, '=', $usuario));

            if($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    public function data() {
        return $this->_data;
    }

    public function login($login = null, $senha = null) {

        $usuario = $this->find($login);

        if($usuario) {
            if($this->_data->senha === Hash::make($senha, $this->data()->salt)) {
                Session::put($this->_sessionName, $this->data()->id);
                return true;
            }
        }

        return false;

    }





}