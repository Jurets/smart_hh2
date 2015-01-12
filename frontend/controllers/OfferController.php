<?php
namespace frontend\controllers;
use Yii;
use yii\data\ActiveDataProvider;
use common\components\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use common\models\Offer;
use common\models\OfferHistory;

class OfferController extends Controller {
    
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
    
    public function actionIndex(){
        
    }
}
