<?php

namespace app\controllers;

use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use Yii;

class UserController extends Controller
{
    public function actionList(): string
    {
        $model = new User\Form\Add();
        $dataProvider = new ActiveDataProvider([
            'query' => User\Form\Update::find(),
            'pagination' => [
                'pageSize' => 20
            ]
        ]);
        return $this->render('list', ['dataProvider' => $dataProvider, 'model' => $model]);
    }

    public function actionView($id)
    {
        $model = User\Form\Update::findOne($id);
        return $this->render('view', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = User\Form\Update::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword($model['password']);
            if ($model->save()) {
                return Yii::$app->response->redirect(['user/view','id' => $model['id']]);
            }
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionAdd(): \yii\web\Response
    {
        $model = new User\Form\Add();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->add()) {
                Yii::$app->session->setFlash('info', 'Пользовтель добавлен');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка в добавление пользователя');
            }
        }
        return $this->redirect(['/user/list']);
    }

    public function actionDelete($id): \yii\web\Response
    {
        $model = User\Form\Delete::findOne($id);
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