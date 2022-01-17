<?php

use kartik\rating\StarRating;
use yii\helpers\Url;

/**
 * @var $problem
 */

$canEdit = Yii::$app->user->identity->role === 'user';
$addRatingUrl = Url::to(['/problem/add-rating']);
$id = $problem['id'];

$addRatingCallback =  <<<JSOUT
                function(event,value,caption)
                {
                        $.ajax(
                        {
                        url: '{$addRatingUrl}',
                        method:'post',
                        data:{
                            value: value,
                            id: {$problem['id']} ,
                        },
                        dataType:'json',
                        success:function(data) { location.reload();}
                        }
                        )
                }
JSOUT;

    $class = \app\models\Problem\View::getClassRating($problem['rating']); ?>
    <div class="container mt-3 <?=$class?>">
        <div class="row border border-2">
            <div class="col text-left p-3">
                <div class=""><span class="problem-content">Инцидент <a href="<?=Url::to(["problem/$id"]);?>">#<?=$id?></a></span></div>
                <div><span class="problem-content"><?=$problem['content']?></span></div>
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
                        'rating:change' => $addRatingCallback
                    ]
                ]);?>
            </div>
            <div class="w-100 p-1"></div>
            <div class="col text-left p-3">
                <?php if($problem['decision']):?>
                    <div><span class="problem-content">Решение:</span></div>
                    <div class="border p-3" id="decision"><span class="problem-content"><?=$problem->decisionContent->content?></span></div>
                <?php endif;?>
            </div>
        </div>
    </div>
