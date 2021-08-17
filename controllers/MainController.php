<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\TestForm;
use app\models\Problem;

class MainController extends Controller
{
    public $layout = 'basic';
    public $view = 'index';

    public function actionIndex()
    {
        $problem = new Problem();
        $model = new TestForm();
        $problems = Problem::find()->all();
        if (Yii::$app->request->post('TestForm')) {
            $model->attributes = Yii::$app->request->post('TestForm');
            if ($model->validate()) {
                $this->layout = 'table';
                return $this->render('table', compact('problems', 'model', 'problem'));
            }
        }
        return $this->render('index', compact('model'));
    }

    public function actionAdd()
    {
        $problem = new Problem();
        $problem->load(Yii::$app->request->post());
        $problems = new Problem();
        $problems->problem = $problem['problem'];
        $problems->decision = $problem['decision'];
        $problem->save();
        return $this->actionTable();
    }

    public function actionTable()
    {
        $this->layout = 'table';
        $problem = new Problem();
        $model = new TestForm();
        $problems = Problem::find()->all();
        return $this->render('table', compact('problems', 'model', 'problem'));
    }
}