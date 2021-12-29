<?php

namespace app\models\Decision;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Html;

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
            [['content', 'user_id', 'problem_id'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'content' => Yii::t('app', 'Решение'),
        ];
    }

    public function getAvatar($username, $image, $user_id)
    {
        $profile = new \app\models\User\Form\Profile(['id' => $user_id]);
        if ($image) {
            return Html::img($profile->getAvatar(), ['widht' => '50', 'height' => '50']);
        }
        return $profile->generateAvatar($username, 50);
    }

    public function getUser($user_id)
    {
        return \app\models\User\User::findOne($user_id);
    }

}