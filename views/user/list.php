<?php
/* @var $this yii\web\View */

/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model app\models\LoginForm */

use app\models\LoginForm;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

use app\models\Problem\Form;
use kartik\rating\StarRating;
use yii\grid\GridView;
use yii\helpers\Url;


?>
<div class="row">
    <div class="col-8 text-left">
        <h1>Список Пользователей</h1>
    </div>
    <?php
    if (Yii::$app->user->identity->role === 'admin') : ?>
    <div class="col-4 text-right">
        <button type="button" class="btn btn-success m-2  " data-toggle="modal" data-target="#addProblemModal">
            Добавить пользователя
        </button>
    </div>
</div>

    <div class="row mt-5 m-lg-0">
        <!-- Modal -->
        <div class="modal fade" id="addProblemModal" tabindex="-1" aria-labelledby="addProblemModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Добавление пользователя
                            <h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                    </div>
                    <?php


                    $form = ActiveForm::begin([
                        'options' => ['class' => 'form form-control-s'],
                        'id' => 'form-signup',
                        'layout' => 'horizontal',
                        'fieldConfig' => [
                            'labelOptions' => ['class' => 'col-lg-2 col-form-label'],
                        ],
                        'action' => '/user/add'
                    ]); ?>
                    <div class="modal-body">
                        <?= $form->field($model, 'username') ?>
                        <?= $form->field($model, 'email') ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
                    </div>
                    <?php
                    ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>
<?php
endif; ?>

<?php
/**
 * @var $dataProvider
 */
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'username',
        'email',
        'status',
        'role',
        ['class' => '\yii\grid\ActionColumn']
    ]
]); ?>

