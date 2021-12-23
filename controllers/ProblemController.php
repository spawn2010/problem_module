<?php

namespace app\controllers;

use app\models\Problem\Problem;
use app\models\Problem\Form;
use Yii;
use yii\web\Controller;

class  ProblemController extends Controller
{
    public function actionList()
    {
        $model = Problem::find();
        if (Yii::$app->user->identity->role === 'user') {
            $model = $model->findByUser(Yii::$app->user->id);
        };
        return $this->render('list', ['model'=>$model]);
    }

    public function actionAdd()
    {
        $model = new Form\Add();
        $model->user_id = Yii::$app->user->id;
        $isSave = $model->load(Yii::$app->request->post()) && $model->save();
        if ($isSave) {
            Yii::$app->session->setFlash('info', 'проблема успешно добавлена');
        } else {
            Yii::$app->session->setFlash('error', 'проблема не добавлена!');
        }
        return $this->redirect(['/problem/list']);
    }

    public function actionAddRating()
    {
        $model = new Form\AddRating();
        return $model->load(Yii::$app->request->post()) && $model->save();
    }

}