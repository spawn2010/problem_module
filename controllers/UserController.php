<?php

namespace app\controllers;

use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;

class UserController extends Controller
{
    public $profile;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $userId = Yii::$app->user->id;
        $this->profile = new User\Form\Profile(['id' => $userId]);
    }

    public function actionList(): string
    {
        $model = new User\Form\Add();
        $dataProvider = new ActiveDataProvider([
            'query' => User\User::find(),
            'pagination' => [
                'pageSize' => 20
            ]
        ]);

        return $this->render('list', ['dataProvider' => $dataProvider, 'model' => $model]);
    }

    public function actionView($id)
    {

        $model = User\User::findOne($id);
        return $this->render('view', ['model' => $model]);
    }

    public function actionProfile()
    {

        if ($this->profile->load(Yii::$app->request->post())) {
            $avatar = UploadedFile::getInstance($this->profile, 'avatar');
            if ($avatar) {
                $this->profile->avatar = sprintf('avatar_%d.%s', $this->profile->id, $avatar->extension);
                $avatar->saveAs(User\User::getAvatarFolder() . $this->profile->avatar);
            }
            $this->profile->save();
        }

        return $this->render('profile', ['profile' => $this->profile]);
    }

    public function actionUpdate($id)
    {
        $model = User\User::findOne($id);
        $update = new User\Form\Update();
        if ($update->update($id)) {
            return $this->redirect(['user/view', 'id' => $model['id']]);
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

        $model = new User\Form\Delete();

        if ($model->delete($id)) {
            Yii::$app->session->setFlash('info', 'Пользовтель Удален');
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка при удалении пользователя');
        }

        return $this->redirect(['/user/list']);

    }
}