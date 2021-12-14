<?php

namespace app\models\Problem\Form;

use app\models\Problem\Problem;
use app\models\User\User;
use Yii;
use yii\base\Model;

class Add extends Model
{
    public $problem;
    public $decision;
    public $user_id;


    public function rules()
    {
        return [
            [['problem', 'decision','user_id'], 'trim'],
            [['problem', 'decision'], 'required'],
            ['user_id','integer'],
            ['user_id','exist', 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $problem = new Problem();
        $problem->problem = $this->problem;
        $problem->decision = $this->decision;
        $problem->user_id = $this->user_id;
        return $problem->save();
    }

    public function attributeLabels()
    {
        return [
            'problem' => Yii::t('app', 'Проблема'),
            'decision' => Yii::t('app', 'Решение'),
        ];
    }


}
