<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "zips".
 *
 * @property integer $id
 * @property integer $zip
 * @property string $state
 * @property string $city
 * @property string $seoname
 * @property double $lat
 * @property double $lng
 *
 * @property Ticket[] $tickets
 */
class Zips extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zips';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zip'], 'integer'],
            [['lat', 'lng'], 'number'],
            [['state'], 'string', 'max' => 2],
            [['city'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'zip' => Yii::t('app', 'Zip'),
            'state' => Yii::t('app', 'State'),
            'city' => Yii::t('app', 'City'),
            'seoname' => Yii::t('app', 'Seoname'),
            'lat' => Yii::t('app', 'Lat'),
            'lng' => Yii::t('app', 'Lng'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['zip_id' => 'id']);
    }
}
