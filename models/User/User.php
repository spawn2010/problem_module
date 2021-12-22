<?php

namespace app\models\User;

use app\models\Problem\Problem;
use app\models\Problem\Query;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
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
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property string $role
 * * @property string $user_image
 */
class User extends ActiveRecord implements IdentityInterface
{
    public const AVATAR_FOLDER = '/static/images';

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
            TimestampBehavior::className(),
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'status' => 'inactive'
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
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'username' => Yii::t('app', 'Логин'),
            'role' => Yii::t('app', 'Роль'),
            'password' => Yii::t('app', 'Пароль'),
            'status' => Yii::t('app', 'Статус'),
            'id' => Yii::t('app', 'ID'),
            'user_image' => Yii::t('app', 'Аватар'),
            'email' => Yii::t('app', 'Email'),

        ];
    }

    public static function getAvatarFolder()
    {
        return Yii::getAlias(sprintf(
            '@webroot%s/',
            self::AVATAR_FOLDER
        ));
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
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
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
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
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

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Устанавливает название файла с аватаром пользователя
     *
     * @param $avatar
     *
     * @property string $avatar
     */
    public function setAvatar($avatar): void
    {
        $this->user_image = $avatar;
    }

    /**
     * Возвращает название файла с аватаром пользователя
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->user_image;
    }

    public function getAvatarUrl(): string
    {
        return sprintf('%s/%s', self::AVATAR_FOLDER, $this->getAvatar());
    }

    public function getProblems()
    {
        return $this->hasMany(Problem::class, ['user_id' => 'id'])->orderByRating();

    }

}