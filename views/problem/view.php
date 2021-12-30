<?php
/**
 * @var $problem
 */

?>
<div class="text-left"><h3><b>Инцидент #<?=$problem['id']?></b></h3></div>
<div class="container mt-3 no_rating rounded">
    <div class="row border rounded">
        <div class="col text-left p-3">
            <div><p class="problem-content"><?=$problem['content']?></p></div>
        </div>
        <div class="w-100 p-1"></div>
        <div class="col text-left p-3">
                <div class="border-top pt-3" id="problem"><span class="problem-meta">Автор: <?=$problem->user['username']?></span></div>
                <div><span class="problem-meta">Добавлено: <?=Yii::$app->formatter->asDatetime($problem['created_at'], 'dd.MM.Y в HH:mm')?></span></div>
        </div>
    </div>
</div>
<?php
foreach ($problem->decisions as $decision){
        echo $this->render('_decision_item',['decision' => $decision]);
}
echo $this->render('_decision_add',['problem' => $problem]);



