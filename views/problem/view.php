<?php
/**
 * @var $problem
 * @var $decision
 */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$user = new \app\models\User\User();
function getAvatar($username,$image,$user_id){
    $profile = new \app\models\User\Form\Profile(['id' => $user_id]);
    if($image){
       return Html::img($profile->getAvatar(),['widht'=>'50','height'=>'50']);
    }
    return $profile->generateAvatar($username,50);
}
function getUser($user_id){
    return \app\models\User\User::findOne($user_id);
}

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
        $avatar = getAvatar(getUser($element['user_id'])->username,getUser($element['user_id'])->user_image,$element['user_id']);
        echo $this->render('_decision_item',['image' => $avatar, 'username' => getUser($element['user_id'])->username, 'decision' => $element]);
    }
}
    $model = new app\models\Decision\Form\Add();
    $form = ActiveForm::begin([
    'action' => Url::to(['problem/decision','id'=>$problem['id']])
    ]); ?>
    <form class="form-row">
        <?= $form->field($model, 'content')->textInput(['placeholder' => "Напишите ваше решение"])->label('') ?>
        <?= Html::submitButton('Добавить решение', ['class' => 'btn btn-success']) ?>
    </form>
<?php
ActiveForm::end(); ?>


