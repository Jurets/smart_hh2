<?php
namespace common\components;
use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Notification as NotificationModel;

class Notification extends \yii\base\Component{
    
    public $userId;
    protected $_notifications;
    
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
        $notification->message = $ticket->title . ' ' . Yii::t('app','has new proposals');
        return $notification->save();
    }
    
    public function addRottenNotification($entityId, $userId=null){
        //TODO implement
    }
    
    public function addFdUpNotification($entityId, $userId=null){
        //TODO implement
    }
    
    public function addOfferedJobsNotification($entityId, $userId=null){
        $notification = $this->createNotification(NotificationModel::TYPE_BELL_OFFERED_JOBS, $userId, 'ticket', $entityId);
        $notification->link = Url::to(['/ticket/review', 'id' => $entityId]);
        $ticket = \common\models\Ticket::findOne($entityId);
        $notification->message = Yii::t('app','You have a new job offer: {title}',[
            'title' => Html::encode($ticket['title']),
        ]);
        return $notification->save();
    }
    
    public function addAcceptedByOwnerNotification($entityId, $userId=null){
        $notification = $this->createNotification(NotificationModel::TYPE_BELL_ACCEPTED_BY_OWNER, $userId, 'ticket', $entityId);
        $notification->link = Url::to(['/ticket/review', 'id' => $entityId]);
        $ticket = \common\models\Ticket::findOne($entityId);
        $notification->message = Yii::t('app','You have been accepted for a job: {title}',[
            'title' => Html::encode($ticket['title']),
        ]);
        return $notification->save();
    }
    
    public function getUnread($userId=null){
        if ($this->_notifications === null) {
            if ($userId === null) {
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
            $otherNotifications = NotificationModel::find()
                    ->byUser($userId)
                    ->unread()
                    ->andWhere(['not', ['type' => NotificationModel::TYPE_BELL_PROPOSAL]])
                    ->all();
            $this->_notifications = array_merge($newProposalNotification, $otherNotifications);
            if (!empty($this->_notifications)) {
                yii\helpers\ArrayHelper::multisort($this->_notifications, 'date', SORT_DESC);
            }
        }
        return $this->_notifications;
    }
    
    public function getUnreadCount($userId=null){
        return count($this->getUnread($userId));
    }
    
    public function markNotificationsAsRead($entityId, $entity='ticket', $userId=null){
        if ($userId === null) {
            $userId = $this->userId;
        }
        NotificationModel::updateAll(['is_read' => 1], [
            'user_id' => $userId,
            'entity' => $entity,
            'entity_id' => $entityId,
        ]);
    }
    
    public function handleNotificationRead(yii\base\Event $event){
        $data = $event->data;
        $this->markNotificationsAsRead($data['entityId'], $data['entity'], $data['userId']);
    }
    
}
