<?php

namespace app\models\Problem\Form;

use app\models\Problem\Problem;
use yii\base\Model;

class AddRating extends Model
{
    public $id;
    public $value;

    public function rules()
    {
        return [
            [['id', 'value'], 'integer'],
            [['value'], 'in', 'range' => [1, 2, 3, 4, 5]],
        ];
    }

    public function formName()
    {
        return '';
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $problem = Problem::findOne($this->id);
        if ($problem === null) {
            return false;
        }
        $problem->rating = $this->value;
        return $problem->save();
    }


}