<?php

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
if (!$decision->evaluations) {
    $class = 'enabled';
} else {
    $class = 'disabled';
}
?>
<div class="item-row mt-3">
    <div class="buttons mr-3">
        <?= Html::a('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35px" height="35px" viewBox="0 0 35 35" version="1.1">
<g id="surface1">
<path style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,0%,0%);fill-opacity:1;" d="M 17.042969 0.03125 C 16.957031 0.0429688 16.769531 0.0742188 16.617188 0.0976562 C 15.863281 0.214844 15.234375 0.515625 14.722656 1 C 14.144531 1.546875 13.742188 2.273438 13.5625 3.09375 C 13.441406 3.667969 13.441406 3.5625 13.425781 8.625 L 13.410156 13.464844 L 8.519531 13.480469 C 4.097656 13.492188 3.605469 13.5 3.363281 13.542969 C 2.457031 13.695312 1.804688 13.988281 1.222656 14.496094 C 0.730469 14.925781 0.40625 15.445312 0.207031 16.121094 C 0.121094 16.410156 0 17.1875 0 17.460938 C 0 17.648438 0.0742188 18.214844 0.136719 18.5 C 0.34375 19.421875 0.953125 20.3125 1.75 20.839844 C 2.144531 21.101562 2.492188 21.257812 2.96875 21.386719 C 3.539062 21.539062 3.203125 21.527344 8.507812 21.542969 L 13.410156 21.5625 L 13.425781 26.386719 C 13.441406 30.648438 13.445312 31.246094 13.484375 31.503906 C 13.734375 33.125 14.554688 34.222656 15.878906 34.71875 C 16.421875 34.921875 17.417969 35.046875 17.882812 34.972656 C 17.972656 34.960938 18.175781 34.925781 18.335938 34.902344 C 18.722656 34.84375 19.050781 34.746094 19.382812 34.589844 C 19.769531 34.40625 20.046875 34.210938 20.355469 33.90625 C 20.964844 33.300781 21.359375 32.5 21.488281 31.59375 C 21.503906 31.476562 21.527344 31.347656 21.535156 31.308594 C 21.546875 31.269531 21.558594 29.0625 21.570312 26.398438 L 21.585938 21.5625 L 26.488281 21.542969 C 29.921875 21.53125 31.445312 21.519531 31.578125 21.496094 C 32.554688 21.339844 33.285156 20.992188 33.875 20.410156 C 34.492188 19.800781 34.792969 19.144531 34.9375 18.085938 C 35 17.632812 35.007812 17.371094 34.964844 17.082031 C 34.839844 16.234375 34.78125 16.015625 34.582031 15.597656 C 34.363281 15.140625 34.125 14.832031 33.730469 14.484375 C 33.152344 13.980469 32.511719 13.695312 31.636719 13.542969 C 31.386719 13.5 30.945312 13.492188 26.472656 13.480469 L 21.585938 13.464844 L 21.570312 8.625 C 21.558594 5.136719 21.542969 3.730469 21.519531 3.582031 C 21.355469 2.535156 21.019531 1.808594 20.394531 1.152344 C 19.800781 0.527344 19.140625 0.203125 18.15625 0.0664062 C 17.789062 0.0117188 17.246094 -0.00390625 17.042969 0.03125 Z M 17.042969 0.03125 "/>
</g>
</svg>',
            Url::to(['problem/evaluation']), [
                'data-method' => 'POST',
                'pointer-ever'=> 'none',
                'class' => "btn btn-link $class",
                'data-params' => [
                    'id' => $decision['id'],
                    'value' => 1,
                ],
            ]) ?>
        <div class="ml-2 mt-2"><?=Html::label($decision['evaluation'])?></div>
        <?= Html::a('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35px" height="35px" viewBox="0 0 35 35" version="1.1">
<g id="surface1">
<path style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,0%,0%);fill-opacity:1;" d="M 35.023438 17.511719 C 35.023438 19.203125 33.652344 20.578125 31.957031 20.578125 L 3.0625 20.578125 C 2.21875 20.578125 1.453125 20.234375 0.898438 19.679688 C 0.34375 19.125 0 18.359375 0 17.511719 C 0 15.820312 1.371094 14.445312 3.066406 14.449219 L 31.960938 14.449219 C 33.652344 14.449219 35.023438 15.820312 35.023438 17.511719 Z M 35.023438 17.511719 "/>
</g>
</svg>',
            Url::to(['problem/evaluation']), [
                'data-method' => 'POST',
                'class' => "btn btn-link $class",
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
