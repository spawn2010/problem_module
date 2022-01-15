<?php

namespace app\models\Decision;

use yii\db\ActiveQuery;

class Query extends ActiveQuery
{
    public function orderByApprove($decision_id = null): Query
    {
        if ($decision_id === null) {
            $this->orderBy('id');
            return $this;
        }
        $this->orderBy(["IF(id = $decision_id, 0, 1)" => SORT_ASC]);
        return $this;
    }
}