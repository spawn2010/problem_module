<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<div class="container-fluid mt-5">
    <div class="col-12 col-md-6 p-2">
        <h1>Список инцидентов</h1>
    </div>
    <div class=" col-md-5">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Добавить инцидент
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Добавление инцидента</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <?php
                    $form = ActiveForm::begin(['options' => ['id' => 'testForm'], 'action' => 'main/add']) ?>
                    <div class="modal-body">
                        <?= $form->field($problem, 'problem') ?>
                        <?= $form->field($problem, 'decision') ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <?= Html::submitButton('отправить', ['class' => 'btn btn-success']) ?>
                    </div>
                    <?php
                    ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>
    <form method="post" class="container mt-4">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Проблема</th>
                <th scope="col">Решение</th>
                <th scope="col">Оценка</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($problems as $problem) { ?>
                <tr>
                    <td><pre><?php
                            echo $problem->problem ?></pre>
                    </td>
                    <td><?php
                        echo $problem->decision ?> </td>
                    <td>
                        <div class="rating-result"></span><?php
                            $i = 1;
                            while ($i <= $problem->rating) {
                                echo '<span class="active"></span>';
                                $i++;
                            } ?> </div>
                    </td>
                </tr>
                <?php
            } ?>
            </tbody>
        </table>
    </form>
</div>