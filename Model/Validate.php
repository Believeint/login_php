<?php


class Validate
{
    private $_passed = false;
    private $_errors = array();
    private $_db = null;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function check($source, $items = array()) {

        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {
                $value = ($source[$item]);
                $item = escape($item);

                if($rule === "obrigatorio" && empty($value)) {
                    $this->addError("{$item} é Obrigatório.");
                } else if(!empty($value)) {
                    switch ($rule) {
                        case 'min';
                            if(strlen($value) < $rule_value) {
                                $this->addError("{$item} precisa ter no mínimo {$rule_value} carácteres.");
                            }
                            break;
                        case 'max':
                            if(strlen($value) > $rule_value) {
                                $this->addError("{$item} só pode ter no máximo {$rule_value} caracteres.");
                            }
                            break;
                        case 'combinam':
                            if($value != $source[$rule_value]) {
                                $this->addError("{$rule_value} precisam ser igual a {$item}");
                            }
                            break;
                        case 'unico':
                            $check = $this->_db;
                            $check->get($rule_value, array($item, '=', $value));

                           /* $check = $this->_db->get($rule_value, array($item, '=', $value));*/

                            if($check->count()) {
                                $this->addError("{$rule_value} Já Existe.");
                            }
                            break;
                    }
                }
            }
        }

        if(empty($this->_errors)) {
            $this->_passed = true;
        }
        return $this;
    }

    public  function addError($error) {
        $this->_errors[] = $error;
    }

    public function errors() {
        return $this->_errors;
    }

    public function passed() {
        return $this->_passed;
    }

}