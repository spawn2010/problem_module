<?php
/**
 * @var Problem $problem
 */

use app\models\Problem\Problem;
use app\models\Problem\Form;
use kartik\rating\StarRating;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
    <div class="row">
        <div class="col-8 text-left">
    <h1>Список инцидентов</h1>
            </div>
<?php
if (Yii::$app->user->identity->role === 'user') : ?>
        <div class="col-4 text-right">
            <button type="button" class="btn btn-success m-2  " data-toggle="modal" data-target="#addProblemModal">
                Добавить инцидент
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
                        <h5 class="modal-title">Добавление инцидента</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                    $problem = new Form\Add();
                    $form = ActiveForm::begin(['action' => ['/problem/add']]) ?>
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
endif; ?>
<div class="container col-md-12">
<?php
$gridColumns = [
    'problem',
    'decision',
    'rating',
];
/**
 * @var $dataProvider
 */
$form = ActiveForm::begin(['action' => ['/problem/add-rating']]);
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
                'value' => static function ($problem) {
                    $addRatingUrl = Url::to(['/problem/add-rating']);
                    $addRatingCallback = <<<JSOUT
                function(event,value,caption)
                {
                        $.ajax(
                        {
                        url: '{$addRatingUrl}',
                        method:'post',
                        data:{
                            value: value,
                            id: {$problem->id} ,
                        },
                        dataType:'json',
                        success:function(data) { location.reload();}
                        }
                        )
                }

JSOUT;
                    $canEdit = Yii::$app->user->identity->role === 'user';
                    return StarRating::widget([
                        'name' => 'rating',
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
                            'displayOnly' => $canEdit,
                        ],
                        'pluginEvents' => [
                            'rating:change' => " $addRatingCallback"
                        ]
                    ]);
                }
            ],
        ]
    ]
);
ActiveForm::end();
?>
</div>
