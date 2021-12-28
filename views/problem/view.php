<?php
/**
 * @var $problem
 */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="text-left"><h3><b>Инцидент #<?=$problem['id']?></b></h3></div>
<div class="container mt-3 no_rating ">
    <div class="row border">
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
    $model = new app\models\Decision\Add();
    $form = ActiveForm::begin([
    'action' => Url::to(['decision/add'])
    ]); ?>
    <form class="form-row">
        <?= $form->field($model, 'content')->textInput(['autofocus' => true,'placeholder' => "Напишите ваше решение"])->label('') ?>
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success', 'name' => 'problem_id', 'value' => $problem['id']]) ?>
    </form>
<?php
ActiveForm::end(); ?>