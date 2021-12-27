<?php
/**
 * @var $problem
 */
?>
<div class="text-left"><h2>Инцидент #<?=$problem['id']?></h2></div>
<div class="container mt-3 no_rating ">
    <div class="row border">
        <div class="col text-left p-3">
            <div><h6><?=$problem['content']?></h6></div>
        </div>
        <div class="w-100 p-1"></div>
        <div class="col text-left p-3">
                <div class="border-top pt-3" id="problem"><span style="font-size: medium; color: gray">Автор: <?=$problem->user['username']?></span></div>
                <div><span style="font-size: medium; color: gray">Добавлено: <?=Yii::$app->formatter->asDatetime($problem['created_at'], 'dd.MM.Y в HH:mm')?></span></div>
        </div>
    </div>
</div>
