<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $model
 */

$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'container col-md-4'],
]) ?>
<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'password') ?>
<?= $form->field($model, 'role') ?>
<?= $form->field($model, 'status') ?>

    <div class="form-group">
        <div>
            <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>