<?php

namespace app\models\Evaluation;

use yii\db\ActiveQuery;

class Query extends ActiveQuery
{
    public function findByDecisionidAndUserid($decision_id, $user_id)
    {
        $this->where(['decision_id' => $decision_id])
            ->andWhere(['user_id' => $user_id]);
        return $this;
    }
}