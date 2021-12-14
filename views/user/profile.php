<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/**
 * @var $model
 */
/**
 * @var $image
 */
?>
<h2>Профиль пользователя</h2>
<?php echo '<img src='.$image.'>';
$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'container col-md-6 mt-2', 'enctype' => 'multipart/form-data'],
    'layout' => 'horizontal',
    'fieldConfig' => [
        'labelOptions' => ['class' => 'col-lg-1 mr-2 col-form-label'],
    ],
]) ?>
<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'password') ?>
<?= $form->field($model, 'user_image')->fileInput()->label('аватар') ?>
<div class="form-group">
    <div>
        <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-success']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>

