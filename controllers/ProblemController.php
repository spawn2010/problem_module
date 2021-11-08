<?php

namespace app\controllers;

use app\models\Problem\Problem;
use app\models\Problem\Form;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class  ProblemController extends Controller
{
    public function actionList()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Problem::find(),
            'pagination' => [
                'pageSize' => 20
            ]
        ]);
        return $this->render('list', ['dataProvider' => $dataProvider]);
    }

    public function actionAdd()
    {
        $model = new Form\Add();
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