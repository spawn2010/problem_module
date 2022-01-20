<?php

use kartik\icons\Icon;
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

<div class="item-row mt-3">
    <div class="buttons mr-3">
        <?= Html::a(Icon::show('plus',['class'=>'fa-3x']),
            Url::to(['problem/evaluation']), [
                'data-method' => 'POST',
                'pointer-ever'=> 'none',
                'class' => "btn ".((!empty($decision->getEvaluations(Yii::$app->user->id)->value)&&($decision->getEvaluations(Yii::$app->user->id)->value === 1)) ? 'disabled' : 'enabled'),
                'data-params' => [
                    'id' => $decision['id'],
                    'value' => 1,
                ],
            ]) ?>
        <div class="ml-3"><?=Html::label($decision['evaluation'])?></div>
        <?= Html::a(Icon::show('minus',['class'=>'fa-3x']),
            Url::to(['problem/evaluation']), [
                'data-method' => 'POST',
                'class' => "btn ".((!empty($decision->getEvaluations(Yii::$app->user->id)->value)&&($decision->getEvaluations(Yii::$app->user->id)->value !== 1)) ? 'disabled' : 'enabled'),
                'data-params' => [
                    'id' => $decision['id'],
                    'value' => -1,
                ],
            ]) ?>

    </div>
    <div class="item">
        <div class="border rounded">
            <div class="col text-left p-3 rounded border-bottom" style="background: #f6f8fa">
                <span><?=$img?></span>
                <span>Пользователь <?=$decision->user->username?></span>
                <span>добавил решение <?=Yii::$app->formatter->asDatetime($decision->created_at, 'dd.MM.Y в HH:mm')?></span>
                <?php if($decision->id === $decision->problem->decision) : ?>
                    <p class="badge badge-success float-right">Принятое решение</p>
                <?php endif ?>
            </div>
            <div class="w-100"></div>
            <div class="row m-1">
            <div class="text-left col-4 mt-2">
                <text>
                    <?=$decision['content']?>
                </text>
            </div>
            <div class="text-right col-8">
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
    </div>
</div>
