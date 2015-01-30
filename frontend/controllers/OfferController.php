<?php
namespace frontend\controllers;
use Yii;
use yii\data\ActiveDataProvider;
use common\components\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use common\models\Offer;
use common\models\OfferHistory;
use common\modules\user\models\Profile;

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
        var_dump(date_default_timezone_get());
    }
    
    public function actionTest(){
        $online = Profile::findOne(['user_id'=>Yii::$app->user->id])->updateOnline()->online;
        return $this->render('test', ['online'=>$online]);
    }
}
