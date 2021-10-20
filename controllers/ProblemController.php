<?php

namespace app\controllers;

use app\models\Problem;
use Yii;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class ProblemController extends Controller
{
    public function actionList ()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Problem::find(),
            'pagination' => [
                'pageSize' => 20
            ]
        ]);
        $problem = new Problem();
        return $this->render('table', compact('problem', 'dataProvider'));

    }

    public function actionAddproblem ()
    {
        $model = new Problem();
        if (  $model->load(Yii::$app->request->post()) && $model->validate()){
            $model->save();
        }else{
            $errors = $model->errors;
        }
        return $this->redirect('/problem/list');

    }

    public function actionAddrating ()
    {
        $model = Problem::find()->where(['id' => (Yii::$app->request->post('id'))])->one();
        if (!empty($model)) {
            $model->rating = (Yii::$app->request->post('stars'));
            if ($model->save()) {
                return true;
            }

        }
        return false;
    }

}