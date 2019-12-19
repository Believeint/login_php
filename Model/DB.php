<?php


class DB
{
    // Pattern Singleton, Conexão com db estática
    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error,
            $_results,
            $_count = 0;

    private function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/db'),Config::get('mysql/username'),Config::get('mysql/password'));
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // Cria uma nova instância de bd se não houver
    public static function getInstance()
    {
        if(!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    // Executa a Query
    public function query($sql, $params = array())
    {
        $this->_error = false;

        if($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if(count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            if($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }
        return $this;
    }

    // Realiza operações CRUD
    public function action($action, $table, $where = array()) {
        if(count($where) === 3)
        {
            $operators = array('=', '>', '<', '>=', '<=');

            $field    = $where[0];
            $operator = $where[1];
            $value    = $where[2];

            if(in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if(!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
            return false;
        }
    }

    // Retorna resultados especificados
    public function get($table, $where)
    {
        return $this->action('SELECT *', $table, $where);
    }

    // Insere dados
    public function insert($table, $fields = array()) {

            $keys = array_keys($fields);
            $values = '';
            $x = 1;

            foreach ($fields as $field) {
                $values .= '?';
                if($x < count($fields)) {
                    $values .= ', ';
                }
                $x++;
            }

        $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";
            if(!$this->query($sql, $fields)->error()) {
                return true;
            } else {
            return false;
            }
    }

    // Atualiza dados
    public function update($table, $id ,$fields = array()) {
        $set = '';
        $x = 1;

        foreach ($fields as $name => $value) {
            $set .= "{$name} = ?";
            if($x < count($fields)) {
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";
        if(!$this->query($sql, $fields)->error()) {
            return true;
        } else {
            return false;
        }
    }

    // Deleta dados
    public function Delete($table, $where)
    {

            return $this->action($table, $where);


    }

    // Retorna o estado erro da ultima ação
    public function error() {
        return $this->_error;
    }

    public function first() {
        return $this->result()[0];
    }

    public function count() {
        return $this->_count;
    }

    public function result() {
        return $this->_results;
    }
}