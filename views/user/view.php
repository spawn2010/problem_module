<?php

use kartik\rating\StarRating;
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
echo '<div class="container">';
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

$data = [];
$i = 0;
$k = 1;
foreach ($model->getProblem()->all() as $value){
    if (!$value['decision'] or !$value['rating']){
        $data[$i] = $value;
    }
    $data[$i] = $value;
    if($data[$i]['rating'] > $data[$k-1]['rating']){
        $data[$i] = $data[$i+1];
    }
    $i++;
    $k++;
}

$id = 'problem4';

foreach ($data as $problem){
    if ($problem['rating'] > 4 ){
        $id = 'problem1';
    }elseif ($problem['rating'] > 3){
        $id = 'problem2';
    }elseif ($problem['rating']){
        $id = 'problem3';
    }
    echo '<div class="container mt-3" id="'.$id.'">
<div class="row border border-2">
  <div class="col text-left p-3">
  <div class=""><h6>Инцидент:</h6></div>
  <div><h6>'.$problem['problem'].'</h6></div>
  </div>
  <div class="col text-right">'.StarRating::widget([
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

        ]).'</div>
  <div class="w-100 p-1"></div>
  <div class="col text-left p-3">
  <div><h6>Решение:</h6></div>
  <div class="border p-3" id="decision"><h6>'.$problem['decision'].'</h6></div>
  </div>
  </div>
</div>';
}



