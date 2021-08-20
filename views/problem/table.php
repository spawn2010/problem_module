<?php

use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap4\Modal;

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
$form = ActiveForm::begin(['options' => ['id' => 'testForm'], 'action' => '/problem/addrating']);
echo GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'columns' => [
            'problem',
            'decision',
            [
                'attribute' => 'rating',
                'format' => 'raw',
                'value' => function ($problem) use ($form) {
// return $problem->rating ? '<span class="text-success">Показывается</span>' : '<span class="text-danger">Не показывается</span>';
                    if ($problem->rating != null) {
                        for ($n = 5; $n != 0; $n--) {
                            if ($problem->rating == 1) {
                                $s = '<div class="rating-result">
    <span class="active"></span>
</div>';
                            } elseif ($problem->rating == 2) {
                                $s = '<div class="rating-result">
    <span class="active"></span>
    <span class="active"></span>

</div>';
                            } elseif ($problem->rating == 3) {
                                $s = '<div class="rating-result">
    <span class="active"></span>
    <span class="active"></span>
    <span class="active"></span>
</div>';
                            } elseif ($problem->rating == 4) {
                                $s = '<div class="rating-result">
    <span class="active"></span>
    <span class="active"></span>
    <span class="active"></span>
    <span class="active"></span>
</div>';
                            } elseif ($problem->rating == 5) {
                                $s = '<div class="rating-result">
    <span class="active"></span>
    <span class="active"></span>
    <span class="active"></span>
    <span class="active"></span>
    <span class="active"></span>
</div>';
                            }
                            return $s;
                        }
                    } elseif (Yii::$app->user->identity['username'] === 'admin') {
                        return '   <div class="rating-area">
    <input type="submit" id="1" name="sdds" value="5">
    <label for="1" title="Оценка «5»"></label>
    <input type="submit" id="star-4" name="4" value="4">
    <label for="star-4" title="Оценка «4»"></label>
    <input type="submit" id="star-3" name="3" value="3">
    <label for="star-3" title="Оценка «3»"></label>
    <input type="submit" id="star-2" name="2" value="2">
    <label for="star-2" title="Оценка «2»"></label>
    <input type="submit" id="star-1" name="1" value="1">
    <label for="star-1" title="Оценка «1»"></label>
</div>';
                    } else {
                        return '';
                    }
                }
            ],
        ]
    ]
);
ActiveForm::end();

