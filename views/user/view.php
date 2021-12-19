<?php

use yii\widgets\DetailView;

/**
 * @var $model
 */
/**
 * @var $profile
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

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'username',
        'role',
        'email',
        'status',
        $avatar

    ],
]);
