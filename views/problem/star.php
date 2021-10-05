<?php

use kartik\rating\StarRating;

// Advanced theming and ability to use richer markup (e.g. SVG).
// Use the inbuilt Krajee SVG theme for rendering SVG icons
$id =1;

echo StarRating::widget(['name' => 'rating_21',
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
        'displayOnly' => false,
    ],
    'pluginEvents' => [
        'rating:change' => "function(event,value,caption){
        $.ajax(
        {
        url:'/site/stars',
        method:'post',
        data:{
            stars:value,
            id:".$problem['id'].",
        },
        dataType:'json',
        success:function(data){
            location.reload();
        }
        }
        )
       }"
    ]
]);
/*
$form = \yii\widgets\ActiveForm::begin();
echo $form->field($problem, 'rating')->widget(StarRating::widget(['name' => 'rating_21',
    'value' => 3,
    'pluginOptions' => [
        'theme' => 'krajee-uni',
        'showClear' => false,
        'showCaption' => false,
        'min' => 0,
        'max' => 5,
        'step' => 1,
        'size' => 'md',
        'language' => 'ru',
        'displayOnly' => false,
    ]
]));
\yii\widgets\ActiveForm::end();
*/