<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $decision
 */
$profile = new \app\models\User\Form\Profile(['id' => $decision->user->id]);
if ($decision->user->user_image) {
    $img =  Html::img($profile->getAvatar(),['widht'=>'100','height'=>'100']);
}else{
    $img = $profile->generateAvatar($decision->user->username, 50);
}
?>
<div class="container-fluid">
    <div>
        <?php if (!$decision->evaluations){
            $url = 'problem/evaluation';
        }else{
            $url = 'problem/'.$decision->problem->id.'';
        }
        ?>
        <?= Html::a('&#9650',
            Url::to([$url]), [
                'data-method' => 'POST',
                'class'=>'btn-success h3',
                'pointer-ever'=> 'none',
                'data-params' => [
                    'id' => $decision['id'],
                    'value' => 1,
                ],
            ]) ?>
        <span><?=Html::label($decision['evaluation'])?></span>
        <?= Html::a('&#9660',
            Url::to([$url]), [
                'data-method' => 'POST',
                'class'=>'btn-success h3',
                'data-params' => [
                    'id' => $decision['id'],
                    'value' => -1,
                ],
            ]) ?>

    </div>
    <div class="row border rounded mt-3">
        <div class="col text-left p-3 rounded border-bottom" style="background: #f6f8fa">
            <span><?=$img?></span>
            <span>Пользователь <?=$decision->user->username?></span>
            <span>добавил решение <?=Yii::$app->formatter->asDatetime($decision->created_at, 'dd.MM.Y в HH:mm')?></span>
            <?php if($decision->id === $decision->problem->decision) : ?>
            <p class="badge badge-success float-right">Принятое решение</p>
            <?php endif ?>
        </div>
        <div class="w-100"></div>
        <div class="col text-left m-3">
            <text>
                <?=$decision['content']?>
            </text>
        </div>
        <div class="m-3">
            <?php if ($decision->problem->decision === null && $decision->problem->user_id == Yii::$app->user->id): ?>
                <?=Html::a('Принять решение',
                    ['approve'], [
                        'class' => 'btn btn-success',
                        'data-method' => 'POST',
                        'data-params' => [
                            'decision' => $decision['id'],
                            'id' => $decision['problem_id'],
                        ],
                    ])?>
            <?php endif; ?>
        </div>
    </div>
</div>




