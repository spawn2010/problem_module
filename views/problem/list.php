<?php
/**
 * @var Problem $problem
 */
/**
 * @var $model
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
                        <?= $form->field($problem, 'content')->textarea() ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <?= Html::submitButton('отправить', ['class' => 'btn btn-success']) ?>
                    </div>
                    <?php
                    ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>
<?php
endif;

$canEdit = Yii::$app->user->identity->role === 'user';
$addRatingUrl = Url::to(['/problem/add-rating']);
function addRatingCallback($id, $url){
    return <<<JSOUT
                function(event,value,caption)
                {
                        $.ajax(
                        {
                        url: '{$url}',
                        method:'post',
                        data:{
                            value: value,
                            id: {$id} ,
                        },
                        dataType:'json',
                        success:function(data) { location.reload();}
                        }
                        )
                }
JSOUT;
}

foreach ($model->all() as $problem){
    $class = \app\models\Problem\View::getClassRating($problem['rating']); ?>
    <div class="container mt-3 <?=$class?>">
        <div class="row border border-2">
            <div class="col text-left p-3">
                <div class=""><h6>Инцидент:</h6></div>
                <div><h6><?=$problem['content']?></h6></div>
            </div>
            <div class="col text-right"><?=StarRating::widget([
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
                        'rating:change' => addRatingCallback($problem['id'],$addRatingUrl)
                    ]
                ]);?>
            </div>
            <div class="w-100 p-1"></div>
            <div class="col text-left p-3">
                <?php if($problem['decision']):?>
                <div><h6>Решение:</h6></div>
                <div class="border p-3" id="decision"><h6><?=$problem['decision']?></h6></div>
                <?php endif;?>
            </div>
        </div>
    </div>
<?php }?>




