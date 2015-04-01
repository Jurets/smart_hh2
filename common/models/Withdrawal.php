<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "withdrawal".
 *
 * @property integer $id
 * @property string $data
 * @property integer $from_user_id
 * @property string $method
 * @property double $amount
 * @property integer $completed
 *
 * @property User $fromUser
 */
class Withdrawal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'withdrawal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data'], 'safe'],
            [['from_user_id', 'method', 'amount'], 'required'],
            [['from_user_id', 'completed'], 'integer'],
            [['method'], 'string'],
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
            'data' => Yii::t('app', 'Data'),
            'from_user_id' => Yii::t('app', 'From User ID'),
            'method' => Yii::t('app', 'Method'),
            'amount' => Yii::t('app', 'Amount'),
            'completed' => Yii::t('app', 'Completed'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromUser()
    {
        return $this->hasOne(User::className(), ['id' => 'from_user_id']);
    }
    public function modelConnection($compile) {
        $this->from_user_id = $compile['from_user_id'];
        $this->method = $compile['method'];
        $this->amount = $compile['amount'];
    }
}
