<?php

namespace app\models\Decision;

use yii\db\ActiveQuery;

class Query extends ActiveQuery
{
    public function orderByApprove($decision_id): Query
    {
        if ($decision_id) {
            $this->orderBy(["IF(id = $decision_id, 0, 1)" => SORT_ASC]);
            return $this;
        }
        $this->orderBy('id');
        return $this;
    }
}