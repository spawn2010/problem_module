<?php

namespace app\models\User\Form;

use app\models\User\User;

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