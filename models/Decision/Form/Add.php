<?php

namespace app\models\Decision\Form;

use app\models\Decision\Decision;
use yii\base\Model;

class Add extends Model
{
    public $content;
    public $problem_id;
    public $user_id;

    public function rules()
    {
        return [
            [['content'], 'trim'],
            [['content', 'user_id', 'problem_id'], 'required'],
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $decision = new Decision();
        $decision->content = $this->content;
        $decision->problem_id = $this->problem_id;
        $decision->user_id = $this->user_id;
        return $decision->save();
    }


}