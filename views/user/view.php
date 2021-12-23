<?php

use yii\helpers\Url;
use yii\widgets\DetailView;

/**
 * @var $model
 */
/**
 * @var $profile
 */
/**
 * @var $problems
 */
?>
    <h2>Информация о пользователе <?= $model->username ?></h2>
<?php

if ($model['user_image']){
    $model['user_image'] = $model->getAvatarUrl();
    $avatar = 'user_image:image';
}else{
    $model['user_image'] =  $profile->generateAvatar($model->username);
    $avatar =  [
        'attribute' => 'user_image',
        'format'=>'raw',
        'value' => $model['user_image'],
    ];
}
?>
<div class="container">
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'username',
        'role',
        'email',
        'status',
        $avatar

    ],
]);?>
<?php

foreach ($model->problems as $problem){
    echo $this->render(Url::to(['/problem/_list_item']), ['problem' => $problem]);
}




