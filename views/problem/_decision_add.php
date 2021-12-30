<?php
/**
 * @var $problem
 */
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$model = new app\models\Decision\Form\Add();
$form = ActiveForm::begin([
    'action' => Url::to(['problem/decision','id'=>$problem['id']])
]); ?>
    <?= $form->field($model, 'content')->textarea(['placeholder' => "Напишите ваше решение"])->label('') ?>
    <div class="text-right">
        <?= Html::submitButton('Добавить решение', ['class' => 'btn btn-success']) ?>
    </div>
<?php
ActiveForm::end(); ?>