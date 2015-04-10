<?php

namespace backend\controllers;

use Yii;
use common\models\Ticket;
use common\models\User;
use common\models\TicketSearch;
use common\models\TicketArchiveSearch;
//use yii\web\Controller;
use common\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

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
            'Admin' => 'All',
        ];
    }

    /**
     * Lists all Ticket models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TicketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Displays a single Ticket model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Ticket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ticket();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
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
    /* bann */
    public function actionBannmanagement($id){
        $isBann = $this->findModel($id);
        $isBann->bannManager();
        $isBann->save();
        return $this->redirect(['index']);
    }
    /**/
    public function actionTest(){
        
        return $this->render('test');
    }
    public function actionImplementtask(){
         //Check input's values
        if (isset($_POST['code']) && isset($_POST['id'])) {

            $code = Yii::$app->request->post('code');
            $id = Yii::$app->request->post('id');
            
            if (!preg_match('/\d+/', $code)) {
                // if post code is invalid
                echo Json::encode(Array(
                    "result" => false,
                    "text" => "The specified code is incorrect."
                ));
                Yii::$app->end();
            }
            //Try to find Ticket in database
            $ticket = Ticket::findOne(['id'=>$id]);
            //If it's not found throw new exception
            if (!$ticket) {
                echo Json::encode(Array(
                    "result" => false,
                    "text" => "The Ticket with id = '$id' not found."
                ));
                Yii::$app->end();
            }
            //Compare codes
            if ($ticket->system_key != $code) {
                echo Json::encode(Array(
                    "result" => false,
                    "text" => "The code $code is incorrect"
                ));
                Yii::$app->end();
            }
            if ($ticket->status == Ticket::STATUS_COMPLETED) {
                echo Json::encode(Array(
                    "result" => false,
                    "text" => "The Ticket has already completed"
                ));
                Yii::$app->end();
            }
            if ($ticket->status == Ticket::STATUS_EXPIRED) {
                echo Json::encode(Array(
                    "result" => false,
                    "text" => "The Ticket has already expired"
                ));
                Yii::$app->end();
            }
            $ticket->status = Ticket::STATUS_COMPLETED;
            if (1 === 2/*!$ticket->save()*/) {
                echo Json::encode(Array(
                    "result" => false,
                    "text" => "The Ticket hasn't been saved"
                ));
                Yii::$app->end();
            } else {
                //Here we notify employer about new suggestion               
                //Get pefrormer ID
                $customerId = $ticket->user_id;
                //Find his model
                $customer = User::findOne(['id'=>$customerId]);                
                //Send email to employer 
                $email = $customer->email;
                $username = $customer->username;
                $idTicket = $ticket->id;
                
                //$result = Mail::sendToPerformerNotifyAboutClosingTicket($email, $username, $idTicket);
               Yii::$app->mailer->compose('ticket/mail', ['idTicket'=>$idTicket, 'link'=>'http://google.com'])
                        ->setTo($email)
                        ->setSubject('')
                        ->send();
                
                echo Json::encode(Array(
                    "result" => true,
                    "text" => "The Task Completlly done"
                ));
                Yii::$app->end();
            }
        }
        $this->render('implement-task', array());
        
    }
    public function actionActivetickets(){
       $model = new Ticket;
       $tickets = $model->getActiveTickets();
       return $this->render('activeTickets', ['tickets'=>$tickets]);
    }
    public function actionStatusupdate(){
        $model = new Ticket;
        $updateStatuses = $model->getUpdateStatuses();
        return $this->render('ticketUpdateStatuses',['model'=>$model,'ticketUpdateStatuses'=>$updateStatuses]);
    }
    
    /**
     * Lists all Ticket models that are in archive.
     * @return mixed
     */
    public function actionArchive()
    {
        $searchModel = new TicketArchiveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('archive', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Finds the Ticket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ticket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ticket::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
