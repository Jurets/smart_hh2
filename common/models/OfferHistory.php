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
}
