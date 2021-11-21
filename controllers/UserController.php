<?php

namespace app\controllers;

use app\models\Problem\Problem;
use app\models\SignupForm;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use Yii;


class UserController extends Controller
{

    public function actionList()
    {
        $model = new SignupForm();
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 20
            ]
        ]);
        return $this->render('userlist', ['dataProvider' => $dataProvider, 'model' => $model]);
    }

    public function actionView($id)
    {
        $model = User::findOne($id);
        return $this->render('userview', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = User::findOne($id);
        if (($model->load(Yii::$app->request->post()) && $model->save())) {
            return $this->render('userview', ['model' => $model]);
        }

        return $this->render('userupdate', ['model' => $model]);
    }

    public function actionAdd()
    {
        $model = new SignupForm();
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 20
            ]
        ]);
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                Yii::$app->session->setFlash('info', 'Пользовтель добавлен');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка в добавление пользователя');
            }
        }
        return $this->render('userlist', ['dataProvider' => $dataProvider, 'model' => $model]);
    }
}