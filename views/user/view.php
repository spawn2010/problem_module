<?php

use kartik\rating\StarRating;
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
    $class = \app\models\Problem\View::getClassRating($problem['rating']); ?>
<div class="container mt-3 <?=$class?>">
<div class="row border border-2">
  <div class="col text-left p-3">
  <div class=""><h6>Инцидент:</h6></div>
  <div><h6><?=$problem['problem']?></h6></div>
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
                'displayOnly' => true,
            ],

        ])?>
  </div>
  <div class="w-100 p-1"></div>
  <div class="col text-left p-3">
  <div><h6>Решение:</h6></div>
  <div class="border p-3" id="decision"><h6><?=$problem['decision']?></h6></div>
  </div>
  </div>
</div>
<?php }?>



