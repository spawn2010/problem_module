<?php

namespace app\models\Problem;

use app\models\Decision\Decision;
use app\models\User\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 *
 * @property mixed|null $content
 * @property mixed|null $decision
 * @property mixed|null $rating
 * @property mixed|null $created_at
 * @property mixed|null $user_id
 * @property mixed|null $id
 */
class Problem extends ActiveRecord
{

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    'created_at',
                ],
            ],
        ];
    }

    public static function tableName()
    {
        return 'problems';
    }

    public function rules()
    {
        return [
            [['content', 'decision', 'user_id'], 'trim'],
            [['content'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'content' => Yii::t('app', 'Проблема'),
            'decision' => Yii::t('app', 'Решение'),
            'rating' => Yii::t('app', 'Оценка'),
            'user_id' => Yii::t('app', 'Имя пользователя'),
        ];
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getDecisions()
    {
        return $this->hasMany(Decision::class, ['problem_id' => 'id'])->orderByApprove($this->decision);
    }

    public function getApprovedDecision()
    {
        return $this->hasOne(Decision::class, ['id' => 'decision']);
    }

    public static function find()
    {
        return Yii::createObject(Query::class, [get_called_class()]);
    }
}