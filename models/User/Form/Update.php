<?php

namespace app\models\User\Form;

use app\models\User;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;;
use yii2tech\ar\softdelete\SoftDeleteBehavior;



class Update extends User
{
    public $password;
    public function behaviors(): array
    {
        return [
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'status' => 0
                ],
            ],
        ];
    }


}