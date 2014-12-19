<?php

namespace frontend\controllers;

use Yii;
use common\models\Ticket;
use common\models\Category;
use yii\data\ActiveDataProvider;
#use yii\web\Controller;
use common\components\Controller; // with auto ban state control
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Complaint;
use yii\helpers\Url;

/**
 * TicketController implements the CRUD actions for Ticket model.
 */
class TicketController extends Controller
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
    public function convensionInit() {
        return [
            'Customer' => 'index create review',
            'Performer' => 'index view',
            'Guest' => 'index create', // create action has specify protection - redirect 
        ];
    }
    /**
     * Lists all Ticket models.
     * @return mixed
     */
    public function actionIndex($cid=NULL)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Ticket::find()->onCondition(['is_turned_on'=>  Ticket::TURNED_ON]),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        
        $list = Yii::$app->params['languages'];
        $apiKey = Yii::$app->params['apiLanguages'];

        $category = new Category;
        $categories = $category->categoryOutput($cid);
        
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'list' => $list,
            'apiKey' => $apiKey,
            'categories' => $categories,
        ]);
    }

    /**
     * Displays a single Ticket model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $complain = new Complaint;
        return $this->render('view', [
            'model' => $this->findModel($id),
            'complain' => $complain,
        ]);
    }

    /**
     * Creates a new Ticket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /* Guest to login section */
        if(Yii::$app->user->isGuest){
            if(Yii::$app->urlManager->enablePrettyUrl === TRUE){
                $this->redirect(Url::to('/user/login'), TRUE);
            }
            $this->redirect(Url::to('/?r=user/login'), TRUE);
        }
        
        $model = new Ticket();
        $post = Yii::$app->request->post();
        if (!empty($post)) {
            // run creation main service
            if($model->mainInitService($post))
                $this->redirect(['review', 'id'=>$model->id]);
            // redirect to a review
            
        }
        
            $categories = $model->categoryLocate();
            return $this->render('create', [
                'model' => $model,
                'categories' => $categories,
            ]);
        
    }
    public function actionReview($id){
        $model = Ticket::findOne(['id'=>$id]);
        if(!is_null($model)){
            return $this->render('review', ['model'=>$model]);
        }else{
            throw new \yii\web\HttpException('404');
        }
    }

    /**
     * Updates an existing Ticket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Ticket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ticket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ticket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    
    /* action complain */
    public function actionComplain(){
       $complain = new Complaint;
       if(Yii::$app->request->isAjax){
           $post = Yii::$app->request->post();
           $complain->attributes = $post;
           if(!$complain->validate()){
               return $this->renderErrors($complain->errors);
           }else{
               if($this->complainAllreadySend($complain->ticket_id)){
                   return Yii::t('app', 'You have already complained');
               }
               $complain->save(false);
                       Yii::$app->mailer->compose('complaint/ban', ['ticketId'=>$complain->ticket_id])
                        ->setTo($complain->ticket->user->email)
                        ->setSubject('ticket ban')
                        ->send();
               $this->turnOffTicket($complain->ticket_id);
               return Yii::t('app', 'Complain send Success');
           }
       }
    } 
    public function actionTest(){
        $complain = Complaint::findOne(['id'=>2]);
        $user_id = $complain->ticket->user->id;
        var_dump($user_id);
    }
    protected function renderErrors($errors){
        $message = '';
        foreach ($errors as $error){
            $message .= $error[0].'<br>';
        }
        return $message;
    }
    protected function turnOffTicket($ticket_id, $number=3){
        $count = Complaint::howManyComplains($ticket_id);
        if($count >= $number){
            $ticket = Ticket::findOne(['id'=>$ticket_id]);
            $ticket->is_turned_on = Complaint::STATUS_OFF;
            $ticket->save();
        }
    }
    protected function complainAllreadySend($ticket_id){
        if(Complaint::findOne([
            'ticket_id' => $ticket_id,
            'status' => Complaint::STATUS_OFF,
            'from_user_id' => Yii::$app->user->id,
        ]) !== null){
            return true;
        }
        return false;
    }
    protected function findModel($id)
    {
        if (($model = Ticket::findOne(['id'=>$id, 'is_turned_on'=>  Ticket::TURNED_ON])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
