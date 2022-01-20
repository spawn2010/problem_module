<?php

namespace app\models\Evaluation\Form;

use app\models\Decision\Decision;
use app\models\Evaluation\Evaluation;
use app\models\User\User;
use Exception;
use Yii;
use yii\base\Model;

class Add extends Model
{
    public $decision_id;
    public $user_id;
    public $value;

    public function rules()
    {
        return [
            ['user_id', 'exist', 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [
                'decision_id',
                'exist',
                'targetClass' => Decision::className(),
                'targetAttribute' => ['decision_id' => 'id']
            ],
            [['value'], 'integer']
        ];
    }

    /**
     * @return bool
     */
    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $evaluation = new Evaluation();

        $decision = Decision::findOne($this->decision_id);
        $oldValue = Evaluation::find()
            ->where(['decision_id' => $this->decision_id])
            ->andWhere(['user_id' => $this->user_id])
            ->one();

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!is_null($decision) && is_null($oldValue)) {
                $evaluation->decision_id = $this->decision_id;
                $evaluation->user_id = $this->user_id;
                $evaluation->value = $this->value;

                if (!$evaluation->save()) {
                    throw new yii\db\Exception(array_values($evaluation->errors)[0][0]);
                }
            } else {
                Evaluation::deleteAll(['id' => $oldValue->id]);
            }
            $decision->updateAttributes(['evaluation' => $decision['evaluation'] + $this->value]);

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            return false;
        }

        return true;
    }

}