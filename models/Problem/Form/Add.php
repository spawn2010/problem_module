<?php

namespace app\models\Problem\Form;

use app\models\Problem\Problem;
use Yii;
use yii\base\Model;

class Add extends Model
{
    public $problem;
    public $decision;

    public function rules()
    {
        return [
            [['problem', 'decision'], 'trim'],
            [['problem', 'decision'], 'required'],
            [['problem', 'decision'], 'trim'],
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
