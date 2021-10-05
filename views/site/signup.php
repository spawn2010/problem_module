<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Регистрация';
?>

<div class="row justify-content-center align-items-center">
    <div class="col-md-6 cont">
        <h1>Регистрация</h1>
        <br>
        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'form form-control-s'],
            'id' => 'form-signup',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'labelOptions' => ['class' => 'col-lg-1 col-form-label'],
            ],
            'action' => '/site/signup'
        ]); ?>
        <form class="form">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <div class="form-group">

                <?= Html::submitButton('Signup', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>


            </div>
        </form>


        <?php ActiveForm::end(); ?>


    </div>
</div>