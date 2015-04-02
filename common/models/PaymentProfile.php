<?php

namespace common\models;

use Yii;
use yii\web\NotFoundHttpException;

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

    const V1 = 'ACH… 1-2 business days';
    const V2 = 'Paypal… 3-5 business days';
    const V3 = 'Check mailing… up to 10 business days';

    /* for simple review */

    public $choiseKind = [];

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'payment_profile';
    }

    public function init() {
        parent::init();
        $this->choiseKind = [
            '1' => Yii::t('app', 'ACH… 1-2 business days'),
            '2' => Yii::t('app', 'Paypal… 3-5 business days'),
            '3' => Yii::t('app', 'Check mailing… up to 10 business days')
        ];
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
        $this->choise = isset($post['choise']) ? (int) $post['choise'] : NULL;
        $this->ach_routing_number = isset($post['ach_routing_number']) ? \yii\helpers\Html::encode($post['ach_routing_number']) : '';
        $this->ach_account_number = isset($post['ach_account_number']) ? \yii\helpers\Html::encode($post['ach_account_number']) : '';
        $this->ach_account_name = isset($post['ach_account_name']) ? \yii\helpers\Html::encode($post['ach_account_name']) : '';
        $this->paypal = isset($post['paypal']) ? \yii\helpers\Html::encode($post['paypal']) : '';
        $this->mailing_address = isset($post['mailing_address']) ? \yii\helpers\Html::encode($post['mailing_address']) : '';
        $this->fullname = isset($post['fullname']) ? \yii\helpers\Html::encode($post['fullname']) : '';
    }

    public function beforeValidate() {
        parent::beforeValidate();
        switch ($this->choise) {
            case 1:
                if (empty($this->ach_account_name) && empty($this->ach_account_number) && empty($this->ach_routing_number)) {
                    $this->ach_account_name = NULL;
                    $this->ach_account_number = NULL;
                    $this->ach_routing_number = NULL;
                    break;
                }
                if (empty($this->ach_routing_number)) {
                    $this->addError('ach_routing_number', $this->attributeLabels()['ach_routing_number'] . Yii::t('app', ' must be set'));
                }
                if (empty($this->ach_account_number)) {
                    $this->addError('ach_account_number', $this->attributeLabels()['ach_account_number'] . Yii::t('app', ' must be set'));
                }
                if (empty($this->ach_account_name)) {
                    $this->addError('ach_account_name', $this->attributeLabels()['ach_account_name'] . Yii::t('app', ' must be set'));
                }
                break;
            case 2:
                if (empty($this->paypal)) {
                    $this->paypal = NULL;
                }
                break;
            case 3:
                if (empty($this->mailing_address) && empty($this->fullname)) {
                    $this->mailing_address = NULL;
                    $this->fullname = NULL;
                    break;
                }
                if (empty($this->mailing_address)) {
                    $this->addError('mailing_address', $this->attributeLabels()['mailing_address'] . Yii::t('app', ' must be set'));
                }
                if (empty($this->fullname)) {
                    $this->addError('fullname', $this->attributeLabels()['fullname'] . Yii::t('app', ' must be set'));
                }
                break;
        }
        if ($this->hasErrors()) {
            return false;
        }
        return true;
    }

    public function varriantsListCreate() {
        $varList = [];
        if (!empty($this->ach_account_name) && !empty($this->ach_account_number) && !empty($this->ach_routing_number)) {
            $varList['1'] = self::V1;
        }
        if (!empty($this->paypal)) {
            $varList['2'] = self::V2;
        }
        if (!empty($this->mailing_address) && !is_null($this->fullname)) {
            $varList['3'] = self::V3;
        }
        return $varList;
    }

    public static function withdrawalCompile($user_id, $choise, $amount) {
        $model = PaymentProfile::find('user_id = :id', [':id' => $user_id])->one();
        $compile = [];
        $compile['from_user_id'] = (int) $user_id;
        switch ($choise) {
            case 1:
                if (empty($model->ach_account_name) || empty($model->ach_account_number || empty($model->ach_routing_number))) {
                    throw new NotFoundHttpException('601');
                } else {
                    $compile['method'] = self::V1 . ' : ' .
                            $model->getAttributeLabel('ach_account_name') . ' - ' . $model->ach_account_name . '; ' .
                            $model->getAttributeLabel('ach_account_number') . ' - ' . $model->ach_account_number . '; ' .
                            $model->getAttributeLabel('ach_routing_number') . ' - ' . $model->ach_routing_number . '; ';
                }
                break;
            case 2:
                if (empty($model->paypal)) {
                    throw new NotFoundHttpException('602');
                } else {
                    $compile['method'] = self::V2 . ' : ' .
                            $model->getAttributeLabel('paypal') . ' - ' . $model->paypal . '; ';
                }
                break;
            case 3:
                if (empty($model->mailing_address || empty($model->fullname))) {
                    throw new NotFoundHttpException('603');
                } else {
                    $compile['method'] = self::V3 . ' : ' .
                            $model->getAttributeLabel('mailing_address') . ' - ' . $model->mailing_address . '; ' .
                            $model->getAttributeLabel('fullname') . ' - ' . $model->fullname . '; ';
                }
                break;
            default:
                throw new NotFoundHttpException('700');
        }
        $compile['amount'] = (double) $amount;

        return $compile;
    }

    /* validation additional method - agreement for delete ability */
    public function checkFieldsEmpty() {
        if (
                empty($this->ach_routing_number) &&
                empty($this->ach_account_number) &&
                empty($this->ach_account_name) &&
                empty($this->paypal) &&
                empty($this->mailing_address) &&
                empty($this->fullname)
        ) {

            return FALSE;
        }
        return TRUE;
    }
    /* return message about user payee details default choise */
    public function getChoiseMessage(){
        return $this->choiseKind[$this->choise];
    }
}
