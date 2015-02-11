<?php
namespace common\models\queries;
use yii\db\ActiveQuery;
use common\models\TicketComments;

class TicketCommetsQuery extends ActiveQuery{
    public function newComments(){
        $this->andWhere(['status' => TicketComments::STATUS_NEW]);
        return $this;
    }
}
