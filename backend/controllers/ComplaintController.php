<?php

namespace backend\controllers;

use Yii;
use common\models\Complaint;
use common\models\Ticket;
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
    public function actionInfo($id){
        $model = Complaint::getTicketComplains($id);
        return $this->render('info', ['model'=>$model]);
    }
    public function actionDisban($id){
        $ticket = Ticket::findOne(['id'=>$id]);
        $ticket->is_turned_on = Ticket::TURNED_ON;
        $ticket->save();
        $complaint = new Complaint;
        $complains = Complaint::getTicketComplains($id);
        $complaint->changeStatus($complains);
        
        return $this->redirect('index');
    }
}
