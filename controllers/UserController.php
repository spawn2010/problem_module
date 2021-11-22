<?php

namespace app\controllers;

use app\models\SignupForm;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use Yii;

class UserController extends Controller
{

    public function actionList(): string
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

    public function actionUpdate($id): string
    {
        $model = User::findOne($id);
        $model->setPassword($model['password']);
        $model->generateAuthKey();
        if ($model->load(Yii::$app->request->post()) && $model->update()) {
            return $this->render('userview', ['model' => $model]);
        }

        return $this->render('userupdate', ['model' => $model]);
    }

    public function actionAdd(): \yii\web\Response
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                Yii::$app->session->setFlash('info', 'Пользовтель добавлен');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка в добавление пользователя');
            }
        }
        return $this->redirect(['/user/list']);
    }

    public function actionDelete($id): \yii\web\Response
    {
        $model = User::findOne($id);

        if ($model) {
            if ($model->softDelete()) {
                Yii::$app->session->setFlash('info', 'Пользовтель Удален');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при удалении пользователя');
            }
        }
        return $this->redirect(['/user/list']);
    }
}