<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<?php
if (Yii::$app->session->hasFlash('success')) {
    echo Yii::$app->session->hasFlash('success');
} ?>
<?php
$form = ActiveForm::begin(['options' => ['id' => 'testForm']]) ?>
<h1 style="text-align: center;">Авторизация</h1>
<?= $form->field($model, 'name')->textInput(['placeholder' => "Введите логин"]) ?><br>
<?= $form->field($model, 'pass')->textInput(['placeholder' => "Введите пароль"]) ?><br>
<?= Html::submitButton('Авторизоваться', ['class' => 'btn btn-success']) ?>

<button class="btn btn-success" type="submit" name="add" value="1">Зарегестрироваться</button>
<?php
ActiveForm::end() ?>


