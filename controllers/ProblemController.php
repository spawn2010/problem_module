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
        $data = Problem::find()->all();
        return $this->render('table', compact('data', 'problem', 'dataProvider'));
    }

    public function actionAddproblem ()
    {
        $problem = (Yii::$app->request->post('Problem'));
        $user = new Problem();
        $user->problem = htmlspecialchars('' . $problem['problem'] . '');
        $user->decision = htmlspecialchars('' . $problem['decision'] . '');
        $user->save();
        return $this->redirect('/problem/list');

    }
    public function actionAddrating ()
    {
       var_dump(Yii::$app->request->post());
       die();
    }

}