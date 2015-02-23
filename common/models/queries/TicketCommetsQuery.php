<?php
namespace common\models\queries;
use yii\db\ActiveQuery;
use common\models\TicketComments;

class TicketCommetsQuery extends ActiveQuery{
    public function newComments(){
        $this->andWhere([
            'ticket_comments.status' => TicketComments::STATUS_NEW,
                ]);
        return $this;
    }
    
    public function byUserTickets($user_id){
        $this->joinWith('ticket')->andWhere(['ticket.user_id' => $user_id]);
        return $this;
    }
    
    public function replies($user_id){
        $this->joinWith(['parent' => function ($q) {
        $q->from('ticket_comments parent');
    }])->andWhere(['parent.user_id' => $user_id]);
        return $this;
    }
}
