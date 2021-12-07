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
        'status',
        ['attribute' => 'img',
            'value' => $model['user_image'],
            'format' => ['image',['width' => 100, 'height'=>100]]]
    ],
]);
