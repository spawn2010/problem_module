<?php

namespace app\models\Problem;

use yii\db\ActiveQuery;

class Query extends ActiveQuery
{
    public function findByUser($userId)
    {
        $this->where(['user_id' => $userId]);
        return $this;
    }
}