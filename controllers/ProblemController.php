<?php

namespace app\controllers;

use app\models\Decision\Decision;
use app\models\Decision\Form;
use app\models\Evaluation;
use app\models\Problem\Form\Add;
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
        }
        return $this->render('list', ['collection' => $collection]);
    }

    public function actionView($id): string
    {
        $problem = Problem::findOne($id);
        return $this->render('view', ['problem' => $problem]);
    }

    public function actionAdd()
    {
        $model = new Add();
        $model->user_id = Yii::$app->user->id;
        $isSave = $model->load(Yii::$app->request->post()) && $model->save();
        $this->setFlash($isSave);
        return $this->redirect(['/problem/list']);
    }

    /**
     * @throws Yii\db\Exception
     */
    public function actionEvaluation()
    {
        $evaluation = new Evaluation\Form\Add([
            'decision_id' => Yii::$app->request->post('id'),
            'user_id' => Yii::$app->user->id,
            'value' => Yii::$app->request->post('value')
        ]);

        if ($evaluation->save() === false) {
            foreach ($evaluation->getErrors() as $error) {
                $this->showError($error[0]);
            }
        }
        //return Yii::$app->request->post('value');
        return Decision::findOne(Yii::$app->request->post('id'))->evaluation;
    }

    public function actionApprove()
    {
        if ($model = Problem::findOne(Yii::$app->request->post('id'))) {
            $isSave = $model->updateAttributes(['decision' => Yii::$app->request->post('decision')]);
        }
        $this->setFlash($isSave);
        return $this->redirect(Yii::$app->request->referrer);
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

    public function showError ($error)
    {
        Yii::$app->session->setFlash('error', $error);
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