<?php

namespace app\models\User\Form;

use app\models\User\User;
use LasseRafn\InitialAvatarGenerator\InitialAvatar;
use Yii;
use yii\base\Model;


class Profile extends Model
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $avatar;

    public function getAvatar()
    {
        $user = User::findOne($this->id);
        if ($user === null) {
            return false;
        }

        return $user->getAvatarUrl();
    }

    public function save()
    {
        if ($this->validate() === false) {
            return false;
        }

        $user = User::findOne($this->id);
        if ($user === null) {
            return false;
        }

        $user->username = $this->username;
        $user->email = $this->email;
        $user->setAvatar($this->avatar);
        $user->setPassword($this->password);
        return $user->save();
    }

}