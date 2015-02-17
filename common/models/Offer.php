<?php

namespace common\models;

use Yii;
use common\modules\user\models\User;

/**
 * This is the model class for table "offer".
 *
 * @property integer $id
 * @property integer $performer_id
 * @property integer $ticket_id
 * @property integer $stage
 *
 * @property Ticket $ticket
 * @property User $performer
 * @property OfferHistory[] $offerHistories
 */
class Offer extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    const STAGE_COUNTEROFFER = 1; // first stage
    const STAGE_LAST_ANSWER = 2; // performer has last chance
    const STAGE_AGREE = 3; // performer can work with this ticket
    const STAGE_REFUSING = 4; // performer dont may work with this ticket
    const ARCHIVED = 10; // in case of reopening/done ticket all offer records by ticket_id must be archived

    public static function tableName() {
        return 'offer';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['performer_id', 'ticket_id'], 'required'],
            [['performer_id', 'ticket_id', 'stage'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'performer_id' => 'Performer ID',
            'ticket_id' => 'Ticket ID',
            'stage' => 'Stage',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket() {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerformer() {
        return $this->hasOne(User::className(), ['id' => 'performer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOfferHistories() {
        return $this->hasMany(OfferHistory::className(), ['offer_id' => 'id']);
    }

    /* last record in the history */

    public function getOfferHistoryLast() {
        return $this->hasMany(OfferHistory::className(), ['offer_id' => 'id'])
                        ->orderBy('date DESC')
                        ->limit(1)
                        ->one();
    }
    
    /* search live offer record */
    public static function findCurrentOffer($performer_id, $ticket_id){
        return self::find()
                ->where(['performer_id'=>$performer_id, 'ticket_id'=>$ticket_id])
                //->andWhere('stage < '.self::STAGE_AGREE)
                ->one();
        
    }
    
}
