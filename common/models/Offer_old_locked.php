<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "offer".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $ticket_id
 * @property double $price
 * @property string $offer_date
 * @property integer $status_agree
 *
 * @property Ticket $ticket
 * @property User $user
 */
class Offer extends \yii\db\ActiveRecord
{
    /*
     * Consts section
     */
    const DISAGREE = 0;
    const AGREE = 1;
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
            [['user_id', 'ticket_id'], 'required'],
            [['user_id', 'ticket_id', 'status_agree'], 'integer'],
            [['price'], 'number'],
            [['offer_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'ticket_id' => 'Ticket ID',
            'price' => 'Price',
            'offer_date' => 'Offer Date',
            'status_agree' => 'Status Agree',
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public static function getTicketStatusUpdate(){
        return Offer::find()
                ->joinWith('ticket')
                ->where(['status_agree'=>self::DISAGREE,
                    'offer.user_id'=>Yii::$app->user->id])
                ->all();
    }
}
