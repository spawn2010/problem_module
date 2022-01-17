<?php

namespace app\models\Decision;

use yii\db\ActiveQuery;

class Query extends ActiveQuery
{
    public function orderByApprove($decision_id = null): Query
    {
        $argument = ($decision_id === null) ? 'id' : ["IF(id = $decision_id, 0, 1)" => SORT_ASC];
        $this->orderBy($argument);
        return $this;
    }
}