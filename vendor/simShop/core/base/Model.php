<?php


namespace simFW\base;


use simFW\Db;

abstract class Model {

    public $attributes = [];
    public $errors = [];
    public $rules = [];

    public function __construct() {

        Db::instance();

    }

}