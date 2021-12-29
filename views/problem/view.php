<?php
/**
 * @var $problem
 * @var $decision
 */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
$profile = new \app\models\User\Form\Profile(['id' => Yii::$app->user->id]);
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
       ($av = \app\models\User\User::findOne($element['user_id']));
       var_dump($av['username']);
        var_dump(Yii::$app->formatter->asDatetime($element['created_at'], 'dd.MM.Y в HH:mm'));
        echo $this->render('_decision_item');
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


