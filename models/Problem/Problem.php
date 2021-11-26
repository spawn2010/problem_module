<?php

namespace app\models\Problem;

use Yii;
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
            [['problem', 'decision','user_id'], 'trim'],
            [['problem', 'decision'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'problem' => Yii::t('app', 'Проблема'),
            'decision' => Yii::t('app', 'Решение'),
            'rating' => Yii::t('app', 'Оценка'),
        ];
    }
}