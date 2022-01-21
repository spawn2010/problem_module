<?php

namespace app\models\Evaluation;

use app\models\Decision\Decision;
use app\models\Problem\Problem;
use app\models\User\User;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property mixed|null $decision_id
 * @property mixed|null $user_id
 * @property mixed|null $id
 * @property mixed|null $value
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

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getDecision(): ActiveQuery
    {
        return $this->hasOne(Decision::class, ['id' => 'decision_id']);
    }

    public static function find()
    {
        return Yii::createObject(Query::class, [get_called_class()]);
    }


}