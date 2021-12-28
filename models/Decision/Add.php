<?php

namespace app\models\Decision;

use yii\base\Model;

class Add extends Model
{
    public $content;
    public $problem_id;
    public $user_id;

    public function rules()
    {
        return [
            [['content', 'user_id', 'problem_id'], 'trim'],
            [['content'], 'required'],
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $problem = new Decision();
        $problem->content = $this->content;
        $problem->problem_id = $this->problem_id;
        $problem->user_id = $this->user_id;
        return $problem->save();
    }


}