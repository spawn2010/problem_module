<?php

use app\models\Problem\Problem;
use app\models\Problem\Form;
use kartik\rating\StarRating;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/**
 * @var $dataProvider
 */

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'username',
        'email',
        'role',
        ['class' => '\yii\grid\ActionColumn']
    ]
]); ?>