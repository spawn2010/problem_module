<?php

namespace app\models\User\Form;

use app\models\User;
use yii\base\Model;

class Delete  extends Model
{

    public function delete($id)
    {
        $model = User\User::findOne($id);

        return $model->softDelete();

    }
}