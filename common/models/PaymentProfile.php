<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment_profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $choise
 * @property string $ach_routing_number
 * @property string $ach_account_number
 * @property string $ach_account_name
 * @property string $paypal
 * @property string $mailing_address
 * @property string $fullname
 *
 * @property User $user
 */
class PaymentProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'choise'], 'required'],
            [['user_id', 'choise'], 'integer'],
            [['ach_routing_number', 'ach_account_number', 'ach_account_name', 'paypal', 'mailing_address', 'fullname'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'choise' => Yii::t('app', 'Choise'),
            'ach_routing_number' => Yii::t('app', 'Ach Routing Number'),
            'ach_account_number' => Yii::t('app', 'Ach Account Number'),
            'ach_account_name' => Yii::t('app', 'Ach Account Name'),
            'paypal' => Yii::t('app', 'Paypal'),
            'mailing_address' => Yii::t('app', 'Mailing Address'),
            'fullname' => Yii::t('app', 'Fullname'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
