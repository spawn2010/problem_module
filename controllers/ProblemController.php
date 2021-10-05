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
        //  return $this->render('star',compact('problem'));
        return $this->render('table', compact('data', 'problem', 'dataProvider'));
        // $problem = Problem::find()->where(['id' => 3 ])->one();
        //return $this->render('star',compact('problem'));
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
        $model = Problem::find()->where(['id' => $_POST['id']])->one();
        if (!empty($model)) {
            $model->rating = $_POST['stars'];
            if ($model->save()) {
                return true;
            }

        }
        return false;
    }

}