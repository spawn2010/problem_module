<?php

namespace app\models\User\Form;

use Yii;
use yii\base\Model;
use app\models\User;

class Update extends Model
{
    public function update($id)
    {
        $model = User\User::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword($model['password']);
            return $model->save();
        }

    }
}