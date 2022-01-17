<?php

namespace app\models\Evaluation;

use app\models\Decision\Decision;
use app\models\User\User;
use yii\db\ActiveRecord;

/**
 * @property mixed|null $decision_id
 * @property mixed|null $user_id
 * @property mixed|null $id
 */
class Evaluation extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%evaluations}}';
    }

    public function rules()
    {
        return [
            ['user_id', 'exist', 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [
                'decision_id',
                'exist',
                'targetClass' => Decision::className(),
                'targetAttribute' => ['decision_id' => 'id']
            ]
        ];
    }
}