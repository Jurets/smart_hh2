<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "offer_history".
 *
 * @property integer $id
 * @property integer $offer_id
 * @property double $price
 * @property string $date
 * @property string $note
 *
 * @property Offer $offer
 */
class OfferHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offer_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['offer_id', 'price'], 'required'],
            [['offer_id'], 'integer'],
            [['price'], 'number'],
            [['date'], 'safe'],
            [['note'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'offer_id' => 'Offer ID',
            'price' => 'Price',
            'date' => 'Date',
            'note' => 'Note',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffer()
    {
        return $this->hasOne(Offer::className(), ['id' => 'offer_id']);
    }
    
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        if($insert){
            switch ($this->offer->stage) {
                case Offer::STAGE_OWNER_OFFER:
                    Yii::$app->notification->addOfferedJobsNotification($this->offer->ticket_id, $this->offer->performer_id);
                    break;
                case Offer::STAGE_AGREE:
                    Yii::$app->notification->addAcceptedByOwnerNotification($this->offer->ticket_id, $this->offer->performer_id);
                    break;
            }
        }
    }
}
