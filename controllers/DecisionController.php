<?php

namespace app\controllers;

use app\models\Decision\Add;
use app\models\Problem\Problem;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class DecisionController extends Controller
{
    public function actionAdd()
    {
        $model = new Add();
        $model->user_id = Yii::$app->user->id;
        $model->problem_id = Yii::$app->request->post('problem_id');
        $isSave = ($model->load(Yii::$app->request->post()) and $model->save());
        if ($isSave) {
            Yii::$app->session->setFlash('info', 'проблема успешно добавлена');
        } else {
            Yii::$app->session->setFlash('error', 'проблема не добавлена!');
        }
        return $this->redirect(Url::to(['problem/view', 'id' => $model->problem_id]));
    }
}