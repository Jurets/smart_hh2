<?php
namespace common\models\queries;
use yii\db\ActiveQuery;

class NotificationQuery extends ActiveQuery{
    public function unread(){
        $this->andWhere([
            'notification.is_read' => 0,
                ]);
        return $this;
    }
    
    public function byUser($user_id){
        $this->andWhere(['notification.user_id' => $user_id]);
        return $this;
    }

}
