<?php

namespace app\models\User\Form;

use LasseRafn\InitialAvatarGenerator\InitialAvatar;
use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property string $password write-only password
 * @property string $role
 */
class Profile extends ActiveRecord implements IdentityInterface
{
    public const STATUS_DELETED = 'inactive';
    public const STATUS_ACTIVE = 'active';
    public $password;

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['username', 'role', 'email', 'password'], 'trim'],
            [['user_image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'логин',
            'status' => 'статус',
            'password' => 'пароль',
            'role' => 'роль',
            'email' => 'email'
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password): void
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function getAvatar($id)
    {
        $path = '/web/image/';
        $model = self::findOne($id);
        if (!$model['user_image']) {
            $avatar = new InitialAvatar();
            return $model['user_image'] = $avatar->width(100)->height(100)->name($model->username)->generateSvg()->toXMLString();
        }
        return $path.$model['user_image'];
    }

}