<?php

namespace common\models;

use Yii;

use common\modules\user\models\User;

/**
 * This is the model class for table "proposal".
 *
 * @property integer $id
 * @property integer $price
 * @property integer $performer_id
 * @property integer $ticket_id
 * @property string $date
 * @property string $message
 * @property integer $archived
 *
 * @property Ticket $ticket
 * @property User $performer
 */
class Proposal extends \yii\db\ActiveRecord implements Reply
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proposal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['performer_id', 'ticket_id'], 'required'],
            [['performer_id', 'ticket_id', 'archived'], 'integer'],
            [['price'], 'double'],
            [['date'], 'safe'],
            [['message'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'performer_id' => Yii::t('app', 'Performer ID'),
            'ticket_id' => Yii::t('app', 'Ticket ID'),
            'date' => Yii::t('app', 'Date'),
            'message' => Yii::t('app', 'Message'),
            'archived' => Yii::t('app', 'Archived'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerformer()
    {
        return $this->hasOne(User::className(), ['id' => 'performer_id']);
    }
    /* EXT */
    public function checkProposeExist($ticket_id, $from_user_id){
        $propose = $this->findOne([
            'ticket_id' => $ticket_id,
            'performer_id' => $from_user_id,
            'archived' => 0,
        ]);
        return is_null($propose) ? false : true;
    }
    /* for price into review */
    public function findPropose($ticket_id, $from_user_id){
        return $this->findOne([
            'ticket_id' => $ticket_id,
            'performer_id' => $from_user_id,
            'archived' => 0,
        ]);
    }
    public function getAllProposes($ticket_id){
        return self::findAll([
            'ticket_id' => $ticket_id,
            'archived' => 0,
        ]);
        
    }

    public function getDate() {
        return $this->date;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getPrice() {
        return $this->price;
    }

    public function canOfferPrice() {
        return true;
    }
    
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        if($insert){
            Yii::$app->notification->addNewProposalsNotification($this->ticket_id, $this->ticket->user_id);
        }
    }

}
