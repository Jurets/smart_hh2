<?php

namespace backend\controllers;

use Yii;
use common\models\Complaint;
use yii\data\ActiveDataProvider;


class ComplaintController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new Complaint;
        $dataProvider = new ActiveDataProvider([
            'query' => $model->getSuspectList(),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

}
