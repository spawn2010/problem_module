<?php

namespace app\models\User\Form;

use app\models\User\User;
use LasseRafn\InitialAvatarGenerator\InitialAvatar;
use yii\base\Model;


class Profile extends model
{
    public function findOne($id): ?User
    {
        return User::findOne($id);
    }

    public function getAvatar($id)
    {
        $path = '/web/image/';
        $model = User::findOne($id);
        if (empty($model['user_image'])) {
            $avatar = new InitialAvatar();
            return $model['user_image'] = $avatar->name($model->username)->generate()->stream('png', 100);;
        }
        return $path . $model['user_image'];
    }

}