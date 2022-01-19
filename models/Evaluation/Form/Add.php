<?php

namespace app\models\Evaluation\Form;

use app\models\Decision\Decision;
use app\models\Evaluation\Evaluation;
use app\models\User\User;
use yii\base\Model;

class Add extends Model
{
    public $decision_id;
    public $user_id;
    public $value;

    public function rules()
    {
        return [
            ['user_id', 'exist', 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [
                'decision_id',
                'exist',
                'targetClass' => Decision::className(),
                'targetAttribute' => ['decision_id' => 'id']
            ],
            [['value'], 'integer']
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $evaluation = new Evaluation();

        if (($decision = Decision::findOne($this->decision_id)) && empty($id = $evaluation::find()->where(['decision_id' => $this->decision_id])->andWhere(['user_id' => $this->user_id])->one())) {
            $decision->updateAttributes(['evaluation' => $decision['evaluation'] + $this->value]);
            $evaluation->decision_id = $this->decision_id;
            $evaluation->user_id = $this->user_id;
            $evaluation->value = $this->value;
            return $evaluation->save();
        }
        return $evaluation::deleteAll(['id' => $id->id]);
    }

}