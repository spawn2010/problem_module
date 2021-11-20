<?php

use yii\widgets\DetailView;

/**
 * @var $model
 */
?>
    <h2>Информация о пользователе <?= Yii::$app->user->identity->username ?></h2>
<?php
echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'username',
        'role',
        'email',
    ],
]);
