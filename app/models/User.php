<?php


namespace app\models;

class User extends AppModel {

    public $attributes = [
        'login' => '',
        'password' => '',
        'name' => '',
        'email' => '',
        'address' => '',
    ];

    public $rules = [
        'required' => [
            ['login'],
            ['password'],
            ['name'],
            ['email'],
            ['address'],
        ],
        'email' => [
            ['email'],
        ],
        'lengthMin' => [
            ['pasword', 6],
        ]
    ];

    public function checkUnique() {

        $user = \R::findOne('user', 'login = ? OR email = ?', [$this->attributes['login'], $this->attributes['email']]);
        if ($user) {
            if ($user->login == $this->attributes['login']) {
                $this->errors['unique'][] = 'Указаллый логин уже занят';
            }

            if ($user->email == $this->attributes['email']) {
                $this->errors['unique'][] = 'Указаллый email уже занят';
            }
            return false;
        }
        return true;
    }
}