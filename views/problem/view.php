<?php
/**
 * @var $problem
 * @var $decision
 * @var $model
 */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="text-left"><h3><b>Инцидент #<?=$problem['id']?></b></h3></div>
<div class="container mt-3 no_rating rounded">
    <div class="row border rounded">
        <div class="col text-left p-3">
            <div><p class="problem-content"><?=$problem['content']?></p></div>
        </div>
        <div class="w-100 p-1"></div>
        <div class="col text-left p-3">
                <div class="border-top pt-3" id="problem"><span class="problem-meta">Автор: <?=$problem->user['username']?></span></div>
                <div><span class="problem-meta">Добавлено: <?=Yii::$app->formatter->asDatetime($problem['created_at'], 'dd.MM.Y в HH:mm')?></span></div>
        </div>
    </div>
</div>
<?php
foreach ($decision->all() as $element){
    if ($element['problem_id'] === $problem['id']){
        $avatar = $model->getAvatar($model->getUser($element['user_id'])->username,$model->getUser($element['user_id'])->user_image,$element['user_id']);
        echo $this->render('_decision_item',['image' => $avatar, 'username' => $model->getUser($element['user_id'])->username, 'decision' => $element]);
    }
}
echo $this->render('_form_for_decisions',['problem' => $problem]);



