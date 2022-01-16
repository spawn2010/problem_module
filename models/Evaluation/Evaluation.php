<?php

namespace app\models\Evaluation;

use app\models\Decision\Decision;
use app\models\User\User;

class Evaluation
{
    public static function tableName()
    {
        return '{{%evaluations}}';
    }

    public function rules()
    {
        return [
            [['id','user_id','decision_id'], 'integer','required'],
            ['user_id', 'exist', 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['decision_id', 'exist', 'targetClass' => Decision::className(), 'targetAttribute' => ['decision_id' => 'id']]
        ];
    }
}