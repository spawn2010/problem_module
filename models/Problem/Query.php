<?php

namespace app\models\Problem;

use yii\db\ActiveQuery;

class Query extends ActiveQuery
{
    public function findByUser($userId): Query
    {
        $this->where(['user_id' => $userId]);
        return $this;
    }

    public function orderByRating(): Query
    {
        $this->orderBy('rating');
        return $this;
    }
}