<?php

use kartik\rating\StarRating;
use PhpOffice\PhpSpreadsheet\Style\Border;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\export\ExportMenu;

?>

    <div class="container-fluid mt-5">
        <div class="col-12 col-md-6 p-2">
            <h1>Список инцидентов</h1>
        </div>
        <?php
        if (Yii::$app->user->identity['username'] === 'user') {
            echo '<div class=" col-md-5">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
            Добавить инцидент
        </button>';
        } ?>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Добавление инцидента</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                    $form = ActiveForm::begin(['options' => ['id' => 'testForm'], 'action' => '/problem/addproblem']) ?>
                    <div class="modal-body">
                        <?= $form->field($problem, 'problem') ?>
                        <?= $form->field($problem, 'decision') ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <?= Html::submitButton('отправить', ['class' => 'btn btn-success']) ?>
                    </div>
                    <?php
                    ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>
<?php
$gridColumns = [
    'problem',
    'decision',
    'rating',
];
echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'exportConfig' => [
    ExportMenu::FORMAT_TEXT => false,
    ExportMenu::FORMAT_HTML => false,
    ExportMenu::FORMAT_PDF => false,
    ExportMenu::FORMAT_CSV => false,
    ExportMenu::FORMAT_EXCEL => false,
], 'fontAwesome' => true,
    'dropdownOptions' => [
        'label' => Yii::t('app','Export All'),
        'class' => 'btn btn-default'
    ],

]);
$form = ActiveForm::begin(['options' => ['id' => 'testForm'], 'action' => '/problem/addrating']);
echo GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'summary' => false,
        'columns' => [
            'problem',
            'decision',
            [
                'attribute' => 'rating',
                'format' => 'raw',
                'value' => function ($problem) use ($form) {
                    if ($problem->rating != null) {
                        return StarRating::widget(['name' => 'rating_21',
                            'value' => $problem['rating'],
                            'pluginOptions' => [
                                'theme' => 'krajee-uni',
                                'showCaption' => false,
                                'min' => 0,
                                'step' => 1,
                                'size' => 'md',
                                'displayOnly' => true,
                            ]]);

                    } elseif (Yii::$app->user->identity['username'] === 'admin') {
                        return StarRating::widget(['name' => 'rating_21',
                            'value' => $problem['rating'],
                            'pluginOptions' => [
                                'theme' => 'krajee-uni',
                                'showClear' => false,
                                'showCaption' => false,
                                'min' => 0,
                                'max' => 5,
                                'step' => 1,
                                'size' => 'md',
                                'language' => 'ru',
                                'displayOnly' => false,
                            ],
                            'pluginEvents' => [
                                'rating:change' => "function(event,value,caption){
        $.ajax(
        {
        url:'/problem/addrating',
        method:'post',
        data:{
            stars:value,
            id:" . $problem['id'] . ",
        },
        dataType:'json',
        success:function(data){
            location.reload();
        }
        }
        )
       }"
                            ]
                        ]);
                    } else {
                        return StarRating::widget(['name' => 'rating_21',
                            'value' => 0,
                            'pluginOptions' => [
                                'theme' => 'krajee-uni',
                                'showCaption' => false,
                                'min' => 0,
                                'step' => 1,
                                'size' => 'md',
                                'displayOnly' => true,
                            ]]);
                    }
                }
            ],
        ]
    ]
);
ActiveForm::end();

