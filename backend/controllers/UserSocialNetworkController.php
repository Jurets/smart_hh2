<?php

namespace backend\controllers;

use Yii;
use common\models\UserSocialNetwork;
use common\models\UserSocialNetworkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserSocialNetworkController implements the CRUD actions for UserSocialNetwork model.
 */
class UserSocialNetworkController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserSocialNetwork models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSocialNetworkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserSocialNetwork model.
     * @param integer $social_network_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionView($social_network_id, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($social_network_id, $user_id),
        ]);
    }

    /**
     * Creates a new UserSocialNetwork model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserSocialNetwork();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'social_network_id' => $model->social_network_id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserSocialNetwork model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $social_network_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionUpdate($social_network_id, $user_id)
    {
        $model = $this->findModel($social_network_id, $user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'social_network_id' => $model->social_network_id, 'user_id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserSocialNetwork model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $social_network_id
     * @param integer $user_id
     * @return mixed
     */
    public function actionDelete($social_network_id, $user_id)
    {
        $this->findModel($social_network_id, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserSocialNetwork model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $social_network_id
     * @param integer $user_id
     * @return UserSocialNetwork the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($social_network_id, $user_id)
    {
        if (($model = UserSocialNetwork::findOne(['social_network_id' => $social_network_id, 'user_id' => $user_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
