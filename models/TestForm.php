<?php

namespace app\models;

use yii\base\Model;

class TestForm extends Model
{
    public $name;
    public $pass;

    public function attributeLabels()
    {
        return [
            'name' => '',
            'pass' => '',
        ];
    }

    public function rules()
    {
        return [
            [['name', 'pass'], 'string',],
            [['name', 'pass'], 'required', 'message' => 'Поле обязательно для заполнения'],
            ['pass', 'myRule2'],
        ];
    }

    public function myRule2($attr)
    {
        $pass = Users::find()->asArray()->where(['pass' => md5($this->$attr)])->all();
        $name = $pass = Users::find()->asArray()->where(['login' => ($this->name)])->all();
        if (empty($pass) || empty($name)) {
            $this->addError($attr, 'Неправильный логин или пароль!');
        }
    }
}