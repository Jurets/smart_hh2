<?php

namespace backend\controllers;

use Yii;
use common\models\Compliant;
//use common\models\User;
use common\modules\user\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Json;

use yii\data\ArrayDataProvider;

class CompliantController extends Controller
{
    public function actionIndex()
    {
        $model = new Compliant;
        $dataProvider = new ArrayDataProvider([
            'allModels' => $model->getSuspectsList(),
        ]);
        return $this->render('index', ['model'=>$model,'dataProvider'=>$dataProvider]);
    }
    
    public function actionShow($id){ 
        $user = User::findOne(['id'=>$id]);
        $compliants = Compliant::findAll(['to_user_id'=>$id, 'satisfaction'=>  Compliant::SATISFACTION_NO]);
        return $this->render('show', ['user'=>$user,'compliants'=>$compliants]);
    }
    
    public function actionBann($id){
        /* bann at user model */
            $post = Yii::$app->request->post('bann-reason');
            $user = User::findOne(['id'=>$id]);
            $user->ban_time = date('Y-m-d H:i:s');
            $user->ban_reason = (empty($post)) ? 'Without reason' : $post;
            $user->save();
        /* com[lants satisfaction */    
            $compliants = Compliant::findAll(['to_user_id'=>$id, 'satisfaction'=>  Compliant::SATISFACTION_NO]);
            foreach($compliants as $compliant){
                $compliant->satisfaction = Compliant::SATISFACTION_YES;
                $compliant->save();
            }
        
        
        return $this->redirect('index');
    }

}
