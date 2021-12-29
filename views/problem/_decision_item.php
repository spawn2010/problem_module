<?php
/**
 * @var $image
 * @var $username
 * @var $decision
 */
?>
<div class="container border rounded mt-3">
    <div class="row">
        <div class="col text-left p-3 rounded border-bottom" style="background: #f6f8fa">
            <span><?=$image?></span>
            <span>Пользователь <?=$username?></span>
            <span>добавил решение <?=Yii::$app->formatter->asDatetime($decision['created_at'], 'dd.MM.Y в HH:mm')?></span>
        </div>
        <div class="w-100"></div>
        <div class="col text-left p-3">
            <text>
                <?=$decision['content']?>
            </text>
        </div>
    </div>
</div>

