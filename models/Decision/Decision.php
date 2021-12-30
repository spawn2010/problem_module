<?php

namespace app\models\Decision;

use app\models\Problem\Problem;
use app\models\User\User;
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
        return '{{%decisions}}';
    }

    public function rules()
    {
        return [
            [['content'], 'trim'],
            [['content', 'user_id', 'problem_id'], 'required'],
            ['user_id', 'exist', 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['problem_id', 'exist', 'targetClass' => Problem::className(), 'targetAttribute' => ['problem_id' => 'id']]
        ];
    }

    public function attributeLabels()
    {
        return [
            'content' => Yii::t('app', 'Решение'),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, [
            'id' => 'user_id'
        ]);
    }


}