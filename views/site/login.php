<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Login';
?>
<style>
    .cont {
        min-height: 10em;
        display: table-cell;
        vertical-align: middle
    }
</style>

<div class="row justify-content-center align-items-center">
    <div class="col-md-6 cont">
        <h1>Авторизация</h1>
        <br>
        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'form form-control-s'],
            'id' => 'testForm',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'labelOptions' => ['class' => 'col-lg-1 col-form-label'],
            ],

            'action' => '/site/login'
        ]); ?>
        <form class="form">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('') ?>

            <?= $form->field($model, 'password')->passwordInput()->label('') ?>


            <div class="form-group">

                <?= Html::submitButton('Login', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>


            </div>
        </form>


        <?php ActiveForm::end(); ?>


    </div>
</div>