<?php

namespace app\models\Decision;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property mixed|null $content
 * @property mixed|null $id
 * @property mixed|null $problem_id
 * @property mixed|null $created_at
 * @property mixed|null $user_id
 */

class Decision extends ActiveRecord
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
        return 'decisions';
    }

    public function rules()
    {
        return [
            [['content'], 'trim'],
            [['content','user_id','problem_id'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'content' => Yii::t('app', 'Решение'),
        ];
    }

}