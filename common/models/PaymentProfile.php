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
class PaymentProfile extends \yii\db\ActiveRecord {

    const V1 = 'varriant 1';
    const V2 = 'varriant 2';
    const V3 = 'varriant 3';
    
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'payment_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'choise'], 'required'],
            [['user_id', 'choise'], 'integer'],
            [['ach_routing_number', 'ach_account_number', 'ach_account_name', 'paypal', 'mailing_address', 'fullname'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'choise' => Yii::t('app', 'Choise'),
            'ach_routing_number' => Yii::t('app', 'Ach Routing Number'),
            'ach_account_number' => Yii::t('app', 'Ach Account Number'),
            'ach_account_name' => Yii::t('app', 'Ach Account Name'),
            'paypal' => Yii::t('app', 'Paypal' . ' (number/email)'),
            'mailing_address' => Yii::t('app', 'Mailing Address'),
            'fullname' => Yii::t('app', 'Fullname'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function paymentProfileLoader($post) {
       $this->choise = isset($post['choise']) ? (int)$post['choise'] : NULL;
       $this->ach_routing_number = isset($post['ach_routing_number']) ? \yii\helpers\Html::encode($post['ach_routing_number']) : '';
       $this->ach_account_number = isset($post['ach_account_number']) ? \yii\helpers\Html::encode($post['ach_account_number']) : '';
       $this->ach_account_name =  isset($post['ach_account_name']) ? \yii\helpers\Html::encode($post['ach_account_name']) : '';
       $this->paypal = isset($post['paypal']) ? \yii\helpers\Html::encode($post['paypal']) : '';
       $this->mailing_address =  isset($post['mailing_address']) ? \yii\helpers\Html::encode($post['mailing_address']) : '';
       $this->fullname = isset($post['fullname']) ? \yii\helpers\Html::encode($post['fullname']) : '';
    }

    public function beforeValidate() {
        parent::beforeValidate();
        switch ($this->choise) {
            case 1:
                if (empty($this->ach_routing_number)) {
                    $this->addError('ach_routing_number', $this->attributeLabels()['ach_routing_number'].Yii::t('app', ' must be set'));
                }
                if (empty($this->ach_account_number)) {
                    $this->addError('ach_account_number', $this->attributeLabels()['ach_account_number'].Yii::t('app', ' must be set'));
                }
                if (empty($this->ach_account_name)) {
                    $this->addError('ach_account_name', $this->attributeLabels()['ach_account_name'].Yii::t('app', ' must be set'));
                }
                break;
            case 2:
                if(empty($this->paypal)){
                    $this->addError('paypal', $this->attributeLabels()['paypal'].Yii::t('app', ' must be set'));
                }
                break;
            case 3:
                if(empty($this->mailing_address)){
                    $this->addError('mailing_address', $this->attributeLabels()['mailing_address'].Yii::t('app', ' must be set'));
                }
                if(empty($this->fullname)){
                    $this->addError('fullname', $this->attributeLabels()['fullname'].Yii::t('app', ' must be set'));
                }
                break;
        }
        if ($this->hasErrors()) {
            return false;
        }
        return true;
    }
    
    public function varriantsListCreate(){
        $varList = [];
        if(!empty($this->ach_account_name) && !empty($this->ach_account_number) && !empty($this->ach_routing_number)){
            $varList['1'] = self::V1;
        }
        if(!empty($this->paypal)){
            $varList['2'] = self::V2;
        }
        if(!empty($this->mailing_address) && !is_null($this->fullname)){
            $varList['3'] = self::V3;
        }
        return $varList;
    }

}
