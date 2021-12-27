<?php
/**
 * @var $problem
 */
?>
<div class="container mt-3 no_rating ">
    <div class="row border border-2">
        <div class="col text-left p-3">
            <div class=""><h6>Инцидент #<?=$problem['id']?></h6></div>
            <div><h6><?=$problem['content']?></h6></div>
        </div>
        <div class="w-100 p-1"></div>
        <div class="col text-left p-3">
                <div class="border-top pt-3" id="problem"><h6>Автор: <?=$problem->user['username']?></h6></div>
                <div><h6>Добавлено: <?=Yii::$app->formatter->asDatetime($problem['created_at'], 'dd.MM.Y в HH:mm')?></h6></div>
        </div>
    </div>
</div>
