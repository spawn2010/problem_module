<?php

namespace app\controllers;

use app\models\Problem\Problem;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use Yii;


class UserController extends Controller
{

    public function actionList()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 20
            ]
        ]);
        return $this->render('userlist', ['dataProvider' => $dataProvider]);
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

}