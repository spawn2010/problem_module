<?php

namespace app\models\Evaluation\Form;

use app\models\Decision\Decision;
use app\models\User\User;
use yii\base\Model;

class Add extends Model
{
    public $decision_id;
    public $user_id;

    public function rules()
    {
        return [
            ['id', 'integer'],
            ['user_id', 'exist', 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['decision_id', 'exist', 'targetClass' => Decision::className(), 'targetAttribute' => ['decision_id' => 'id']]
        ];
    }


    public function save()
    {

    }

}