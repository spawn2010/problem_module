<?php

namespace app\models\User\Form;

use app\models\User\User;
use LasseRafn\InitialAvatarGenerator\InitialAvatar;
use phpDocumentor\Reflection\Types\Null_;
use Yii;
use yii\base\Model;
use yii\helpers\Html;


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
        $this->avatar = $user->user_image;
        if ($user->user_image === null) {
            $generateAvatar = new InitialAvatar();
            return $generateAvatar->name($user->username)->size(100)->generateSvg()->toXMLString();
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