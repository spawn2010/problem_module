<?php

namespace app\models\Problem;

use app\models\User\User;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 *
 * @property mixed|null $problem
 * @property mixed|null $decision
 * @property mixed|null $rating
 * * @property mixed|null $user_id
 */
class Problem extends ActiveRecord
{
    public static function tableName()
    {
        return 'problems';
    }

    public function rules()
    {
        return [
            [['problem', 'decision', 'user_id'], 'trim'],
            [['problem', 'decision'], 'required'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'problem' => Yii::t('app', 'Проблема'),
            'decision' => Yii::t('app', 'Решение'),
            'rating' => Yii::t('app', 'Оценка'),
            'user_id' => Yii::t('app', 'Имя пользователя'),
        ];
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, [
            'id' => 'user_id'
        ]);
    }

    public static function find()
    {
        return Yii::createObject(Query::class, [get_called_class()]);
    }
}
