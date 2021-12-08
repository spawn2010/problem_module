<?php

namespace app\models\User\Form;

use yii\base\Model;
use yii\db\ActiveRecord;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

class Delete extends ActiveRecord
{
    public const STATUS_DELETED = 'inactive';
    public const STATUS_ACTIVE = 'active';

    public static function tableName(): string
    {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    public function behaviors(): array
    {
        return [
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'status' => self::STATUS_DELETED
                ],
            ],
        ];
    }
}