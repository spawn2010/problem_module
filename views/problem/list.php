<?php
/**
 * @var Problem $problem
 */
/**
 * @var $collection
 */

use app\models\Problem\Problem;
use app\models\Problem\Form;
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
echo $this->render('collection', ['collection' => $collection->all()]);




