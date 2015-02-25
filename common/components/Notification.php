<?php
namespace common\components;
use Yii;
use yii\helpers\Url;
use common\models\Notification as NotificationModel;

class Notification extends \yii\base\Component{
    
    public $userId;
    
    public function init() {
        parent::init();
        if($this->userId === null){
            $this->userId = Yii::$app->user->id;
        }
    }
    
    public function createNotification($type, $userId=null,   $entity=null, $entityId=null){
        $notification = new NotificationModel();
        $notification->type = $type;
        $notification->user_id = $userId !== null ? $userId : $this->userId;
        $notification->entity = $entity;
        $notification->entity_id = $entityId;
        return $notification;
    }
    
    public function addNewProposalsNotification($entityId, $userId=null){
        $notification = $this->createNotification(NotificationModel::TYPE_BELL_PROPOSAL, $userId, 'ticket', $entityId);
        $notification->link = Url::to(['/ticket/view', 'id' => $entityId]);
        $ticket = \common\models\Ticket::findOne($entityId);
        $notification->message = $ticket->title . Yii::t('app','has new proposals');
    }
    
    public function getUnread($userId=null){
        if($userId === null){
            $userId = $this->userId;
        }
        $newProposalNotification = NotificationModel::find()
                ->select([
                    'date' => 'MAX(notification.date)',
                    'type',
                    'message',
                    'link',
                    'proposal_count' => 'count(*)',
                ])
                ->byUser($userId)
                ->unread()
                ->andWhere([
                    'entity' => 'ticket',
                    'type' => NotificationModel::TYPE_BELL_PROPOSAL,
                    ])
                ->groupBy(['entity_id', 'link', 'type', 'message'])
                ->having('proposal_count > 0')
                ->all();
        return $newProposalNotification;
    }
    
}
