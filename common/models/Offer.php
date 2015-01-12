<?php

namespace common\models;

use Yii;

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
class Offer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['performer_id', 'ticket_id'], 'required'],
            [['performer_id', 'ticket_id', 'stage'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOfferHistories()
    {
        return $this->hasMany(OfferHistory::className(), ['offer_id' => 'id']);
    }
}
