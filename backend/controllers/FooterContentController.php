<?php

namespace backend\controllers;

use Yii;
use common\models\FooterContent;
use common\models\FooterContentSearch;
//use yii\web\Controller;
use common\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\FooterContentManager;

/**
 * FooterContentController implements the CRUD actions for FooterContent model.
 */
class FooterContentController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function convensionInit() {
        return [
            'Admin' => 'All',
        ];
    }
    
    /**
     * Lists all FooterContent models.
     * @return mixed
     */
    public function actionTest() {
        $FCM = new FooterContentManager;
        $FCM->testOutput();
    }

    public function actionIndex() {
        $searchModel = new FooterContentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /* Category Weight management */

    public function actionCweight() {
        $post = Yii::$app->request->post();
        $categoryes = \common\models\Category::findAll(['level' => 1]);

        if (isset($post['cat-weight-sign'])) {
            $catArray = [];
            foreach ($categoryes as $category) {
                $catArray[$category->id] = $category;
            }
            foreach($post['cat'] as $i=>$piece){
                $catArray[$i]->weight = (int)$piece;
                $catArray[$i]->save();
            }
        }
        return $this->render('cweight', ['categoryes' => $categoryes]);
    }

    /**
     * Displays a single FooterContent model.
     * @param integer $id
     * @return mixed
     */
//    public function actionView($id)
//    {
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
//    }

    /**
     * Creates a new FooterContent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new FooterContent();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FooterContent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FooterContent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FooterContent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FooterContent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = FooterContent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
