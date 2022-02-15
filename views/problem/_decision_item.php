<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use app\models\Evaluation\View;
use app\models\User\Form\Profile;

/**
 * @var $decision
 */

$profile = new Profile(['id' => $decision->user->id]);
if ($decision->user->user_image) {
    $img =  Html::img($profile->getAvatar(),['widht'=>'100','height'=>'100']);
}else{
    $img = $profile->generateAvatar($decision->user->username, 50);
}


$value = Yii::$app->user->identity->getEvaluationByDecisionId($decision->id)->value ?? 0;


$active = function ($button, $value){
    return View::getClassEvaluation($button,$value);
};

$addEvaluation = <<<JSOUT
                (function (event) {           
                    $.ajax({
                     type: "POST", 
                     url: "evaluation",
                     data:{
                        value: value,
                        id: parseInt(id) ,
                        },
                     success: function(response) { 
                            document.getElementById('evaluation' + parseInt(id)).textContent = response
                            
                            const checkUp = (Math.abs(Number({$decision->evaluation})) % Math.abs(Number(response)) == 2)
                            const checkDown = (Math.abs(Number(response)) % Math.abs(Number({$decision->evaluation})) == 2)

                              function active (btn) {  
                                  if ($value !== 0){                                
                                      if ($value == 1 && btn == 'down'){            
                                           return (Number({$decision->evaluation}) > 0) ? checkUp : checkDown
                                      }             
                                      if ($value == -1 && btn == 'up'){  
                                           return  (Number({$decision->evaluation}) > 0) ? checkDown : checkUp
                                      }
                                      return (Number(response) == {$decision->evaluation})
                                  }                         
                                  return   ( btn == 'up') ? (value == 1 && Number(response) !== {$decision->evaluation}) : (value == -1 && Number(response) !== {$decision->evaluation})    
                              } 

                            document.getElementById(parseInt(id)+'plus').disabled = active('up')          
                            document.getElementById(parseInt(id)+'minus').disabled = (active('down'))
                     },
                     error: function() {
                          console.log("failure");
                     }
                   });})();
JSOUT;
?>

<div class="item-row mt-3">
    <div class="buttons mr-3">
        <?= Html::button(Icon::show('plus',['class'=>'fa-3x']),
            [ 'class' => "btn plus", 'disabled' => View::getClassEvaluation('up',$value), 'onclick' => $addEvaluation, 'value' => 1, 'id' => $decision->id.'plus']);?>
        <div class="ml-3" id="evaluation<?=$decision->id?>"><?=Html::label($decision->evaluation)?></div>
        <?= Html::button(Icon::show('minus',['class'=>'fa-3x']),
            [ 'class' => "btn minus", 'disabled' => View::getClassEvaluation('down',$value), 'onclick' => $addEvaluation, 'value' => -1, 'id' => $decision->id.'minus']);?>
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
                    <?=$decision->content?>
                </text>
            </div>
            <div class="text-right col-8">
                <?php if ($decision->problem->decision === null && $decision->problem->user_id == Yii::$app->user->id): ?>
                    <?=Html::a('Принять решение',
                        ['approve'], [
                            'class' => 'btn btn-success',
                            'data-method' => 'POST',
                            'data-params' => [
                                'decision' => $decision->id,
                                'id' => $decision->problem_id,
                            ],
                        ])?>
                <?php endif; ?>
            </div>
            </div>
        </div>
    </div>
</div>
