<?php

namespace common\models;
use common\modules\user\models\User;
use Yii;

/**
 * This is the model class for table "payment_history".
 *
 * @property integer $id
 * @property integer $from_user_id
 * @property integer $to_user_id
 * @property string $date
 * @property integer $type
 * @property integer $details
 * @property double $amount
 *
 * @property Ticket $details0
 * @property User $fromUser
 * @property User $toUser
 */
class PaymentHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_user_id', 'to_user_id', 'type', 'details', 'amount'], 'required'],
            [['from_user_id', 'to_user_id', 'type', 'details'], 'integer'],
            [['date'], 'safe'],
            [['amount'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'from_user_id' => Yii::t('app', 'From User ID'),
            'to_user_id' => Yii::t('app', 'To User ID'),
            'date' => Yii::t('app', 'Date'),
            'type' => Yii::t('app', 'Type'),
            'details' => Yii::t('app', 'Details'),
            'amount' => Yii::t('app', 'Amount'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetails0()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'details']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromUser()
    {
        return $this->hasOne(User::className(), ['id' => 'from_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToUser()
    {
        return $this->hasOne(User::className(), ['id' => 'to_user_id']);
    }
    
    /* special additions for model logic */
    // set one payment history record
    //$param == $get from paypal action success 
    public static function setPaymentHistoryRecord($param){
        $model = new PaymentHistory;
        $model->from_user_id = $param['fusr'];
        $model->to_user_id = $param['tusr'];
        $model->details = $param['t']; // ticket id
        $model->type = 0;
        $model->amount = $param['p']; // price
        if(!$model->save()){
            throw new \yii\web\HttpException('500 payment history creation failure');
        }
    }
}
