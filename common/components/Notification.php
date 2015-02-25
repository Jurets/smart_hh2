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
        $notification = $this->createNotification(NotificationModel::TYPE_BELL_ROTTEN, $userId, 'ticket', $entityId);
        $notification->link = Url::to(['/ticket/view', 'id' => $entityId]);
        $ticket = \common\models\Ticket::findOne($entityId);
        $notification->message = Yii::t('app','Your job {title} is on {date}',[
            'title' => Html::encode($ticket['title']),
            'date' => Html::encode($ticket['finish_day']),
        ]);
        $notification->date = date('Y-m-d H:i:s', strtotime('-' . Yii::$app->params['bell.rottenTicketDays'] . ' day', strtotime($ticket->finish_day)));
        return $notification->save();
    }
    
    public function addFdUpNotification($entityId, $userId=null){
        $notification = $this->createNotification(NotificationModel::TYPE_BELL_FD_UP, $userId, 'ticket', $entityId);
        $notification->link = Url::to(['/ticket/review', 'id' => $entityId]);
        $ticket = \common\models\Ticket::findOne($entityId);
        $notification->message = Yii::t('app','Don\'t miss a job You apllied to: {title} is on {date}',[
            'title' => Html::encode($ticket['title']),
            'date' => Html::encode($ticket['finish_day']),
        ]);
        $notification->date = date('Y-m-d H:i:s', strtotime('-' . Yii::$app->params['bell.rottenTicketDays'] . ' day', strtotime($ticket->finish_day)));
        return $notification->save();
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
    
    public function addDoneByPerformerNotification($entityId, $userId=null){
        $notification = $this->createNotification(NotificationModel::TYPE_BELL_DONE_BY_PERFORMER, $userId, 'ticket', $entityId);
        $notification->link = Url::to(['/ticket/view', 'id' => $entityId]);
        $ticket = \common\models\Ticket::findOne($entityId);
        $notification->message = Yii::t('app','Performer has done a job. Please write a review: {title}',[
            'title' => Html::encode($ticket['title']),
        ]);
        return $notification->save();
    }
    
    public function addNewReviewNotification($userId=null){
        $notification = $this->createNotification(NotificationModel::TYPE_BELL_NEW_REVIEW, $userId, 'review');
        $notification->link = Url::to(['/user/default/profile']);
        $notification->message = Yii::t('app','You have a new review!');
        return $notification->save();
    }
    
    public function addPerformerOfferedNewPriceNotification($entityId, $performerId, $price, $userId=null){
        $notification = $this->createNotification(NotificationModel::TYPE_BELL_PERFORMER_OFFERED_NEW_PRICE, $userId, 'ticket', $entityId);
        $notification->link = Url::to(['/ticket/view', 'id' => $entityId]);
        $ticket = \common\models\Ticket::findOne($entityId);
        $performer = \common\modules\user\models\User::findOne($performerId);
        $notification->message = Html::encode($performer['username'])
                . ' ' . Yii::t('app','offered new price for job')
                . ' "' . Html::encode($ticket['title'])
                . '": <span class="red">$'
                . Html::encode($price)
                . '</span>';
        return $notification->save();
    }
    
    public function addOwnerOfferedNewPriceNotification($entityId, $ownerId, $price, $userId=null){
        $notification = $this->createNotification(NotificationModel::TYPE_BELL_OWNER_OFFERED_NEW_PRICE, $userId, 'ticket', $entityId);
        $notification->link = Url::to(['/ticket/review', 'id' => $entityId]);
        $ticket = \common\models\Ticket::findOne($entityId);
        $owner = \common\modules\user\models\User::findOne($ownerId);
        $notification->message = Html::encode($owner['username'])
                . ' ' . Yii::t('app','offered new price for job')
                . ' "' . Html::encode($ticket['title'])
                . '": <span class="red">$'
                . Html::encode($price)
                . '</span>';
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
                    ->past()
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
    
    public function markNotificationsAsRead($entityId, $entity='ticket', $userId=null, $past=true, $types=null){
        $equalsCondition = [
            'entity' => $entity,
            'entity_id' => $entityId,
        ];
        if ($userId !== null) {
            $equalsCondition['user_id'] = $userId;
        }
        if($types !== null){
            $equalsCondition['type'] = $types;
        }
        $condition = $past ? [
            'and',
            $equalsCondition,
            'date<CURRENT_TIMESTAMP'
        ] : $equalsCondition;
        NotificationModel::updateAll(['is_read' => 1], $condition);
    }
    
    public function handleNotificationRead(yii\base\Event $event){
        $data = $event->data;
        $this->markNotificationsAsRead($data['entityId'], $data['entity'], $data['userId']);
    }
    
}
