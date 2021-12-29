<?php

namespace app\controllers;

use app\models\Decision\Decision;
use app\models\Decision\Form;
use app\models\Problem\Form\AddRating;
use app\models\Problem\Problem;
use Yii;
use yii\helpers\Url;
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
        $decision = Decision::find();
        return $this->render('view', ['problem' => $model,'decision' => $decision]);
    }

    public function actionAdd()
    {
        $model = new Form\Add();
        $model->user_id = Yii::$app->user->id;
        $isSave = $model->load(Yii::$app->request->post()) && $model->save();
        $this->setFlash($isSave);
        return $this->redirect(['/problem/list']);
    }

    public function actionAddRating()
    {
        $model = new AddRating();
        return $model->load(Yii::$app->request->post()) && $model->save();
    }

    public function actionDecision($id)
    {
        $model = new Form\Add();
        $model->user_id = Yii::$app->user->id;
        $model->problem_id = $id;
        $isSave = ($model->load(Yii::$app->request->post()) and $model->save());
        $this->setFlash($isSave);
        return $this->redirect(Url::to(['problem/view', 'id' => $id]));
    }

    public function setFlash($isSave)
    {
        if ($isSave) {
            Yii::$app->session->setFlash('info', 'Запись добавлена');
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка при добавлении!');
        }
    }

}