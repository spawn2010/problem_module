<?php

use yii\helpers\Html;
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
<div class="container border rounded mt-3">
    <div class="row">
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




