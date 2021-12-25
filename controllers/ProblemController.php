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
        $collection = Problem::find();
        if (Yii::$app->user->identity->role === 'user') {
            $collection = $collection->findByUser(Yii::$app->user->id);
        };
        return $this->render('list', ['collection'=>$collection]);
    }

    public function actionView($id): string
    {
        $model = Problem::findOne($id);
        return $this->render('view', ['problem' => $model]);
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