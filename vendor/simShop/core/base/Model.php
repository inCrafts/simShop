<?php


namespace simFW\base;


use simFW\Db;
use Valitron\Validator;

abstract class Model {

    public $attributes = [];
    public $errors = [];
    public $rules = [];

    public function __construct() {

        Db::instance();

    }

    public function load($data) {

        foreach ($this->attributes as $attribute => $val) {

            if (isset($data[$attribute])) {
                $this->attributes[$attribute] = $data[$attribute];
            }
        }
    }

    public function save($table) {

        $tbl = \R::dispense($table);
        foreach ($this->attributes as $name => $value) {

            $tbl->$name = $value;
        }
        return \R::store($tbl);
    }

    public function validate($data) {

        Validator::langDir(WWW . '/validator/lang');
        Validator::lang('ru');
        $v = new Validator($data);
        $v->rules($this->rules);
        if ($v->validate()) {
            return true;
        }
        $this->errors = $v->errors();
        return false;
    }

    public function getErrors() {

        $errors = '<ul>';
        foreach ($this->errors as $error) {
            foreach ($error as $item) {
                $errors .= "<li>$item</li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['error'] = $errors;

    }
}