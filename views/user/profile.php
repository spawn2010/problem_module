<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/**
 * @var $profile
 */
/**
 * @var $image
 */
?>
<h2>Профиль пользователя</h2>

<?= Html::img($profile->getAvatar()) ?>

<?php
$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'container col-md-6 mt-2', 'enctype' => 'multipart/form-data'],
    'layout' => 'horizontal',
    'fieldConfig' => [
        'labelOptions' => ['class' => 'col-lg-1 mr-2 col-form-label'],
    ],
]) ?>
<?= $form->field($profile, 'username') ?>
<?= $form->field($profile, 'email') ?>
<?= $form->field($profile, 'password') ?>
<?= $form->field($profile, 'avatar')->fileInput()->label('аватар') ?>
<div class="form-group">
    <div>
        <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-success']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>

