<?php

namespace app\models\User\Form;

use app\models\User\User;
use LasseRafn\InitialAvatarGenerator\InitialAvatar;
use yii\base\Model;


class Profile extends Model
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $avatar;

    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'trim'],
        ];
    }

    public function getAvatar()
    {
        $user = User::findOne($this->id);
        if ($user === null) {
            return false;
        }
        return $this->avatar = $user->getAvatarUrl();
    }

    public function generateAvatar(): string
    {
        $user = User::findOne($this->id);
        if ($user->user_image === null) {
            $generateAvatar = new InitialAvatar();
            return $generateAvatar->name($this->username)->size(100)->generateSvg()->toXMLString();
        }

        return false;
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

        if ($this->avatar) {
            $user->setAvatar($this->avatar);
        }

        if ($this->password) {
            $user->setPassword($this->password);
        }

        return $user->save();
    }

    public function attributes()
    {
        $user = User::findOne($this->id);
        $this->username = $user->username;
        $this->password = $user->password;
        $this->email = $user->email;
    }


}