<?php

namespace app\models;

use yii\db\ActiveRecord;

class Problem extends ActiveRecord
{
    public static function tableName ()
    {
        return 'problems';
    }

    public function rules ()
    {
        return [
            [['problem', 'decision'], 'trim'],
            [['problem', 'decision'], 'required'],
        ];
    }

    public function attributeLabels ()
    {
        return [
            'problem' => 'Проблема',
            'decision' => 'Решение',
            'rating' => 'Оценка',
        ];
    }
}