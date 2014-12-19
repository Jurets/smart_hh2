<?php

namespace common\modules\user\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tbl_profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string  $create_time
 * @property string  $update_time
 * @property string  $full_name
 * @property string  $first_name
 *
 * @property User    $user
 */
class Profile extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return static::getDb()->tablePrefix . "profile";
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            //            [['user_id'], 'required'],
            //            [['user_id'], 'integer'],
            //            [['create_time', 'update_time'], 'safe'],
            [['full_name'], 'string', 'max' => 255],
            [['first_name'], 'string', 'max' => 255],
            [['last_name'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 64],
            [['adress_mailing'], 'string', 'max' => 255],
            [['adress_billing'], 'string', 'max' => 255],
            [['paypal'], 'string', 'max' => 64],
            [['another_payment'], 'string', 'max' => 255],
            [['self_description'], 'string', 'max' => 255],
            [['photo'], 'string', 'max' => 255],
            [['country_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('user', 'ID'),
            'user_id' => Yii::t('user', 'User ID'),
            'create_time' => Yii::t('user', 'Create Time'),
            'update_time' => Yii::t('user', 'Update Time'),
            'full_name' => Yii::t('user', 'Full Name'),
            //Add new fields:
            'first_name' => Yii::t('user', 'First name'),
            'last_name' => Yii::t('user', 'Last name'),
            'phone' => Yii::t('user', 'Phone'),
            'adress_mailing' => Yii::t('user', 'Adress mailing'),
            'adress_billing' => Yii::t('user', 'Adress billing'),
            'paypal' => Yii::t('user', 'Paypal'),
            'another_payment' => Yii::t('user', 'Another payment'),
            'self_description' => Yii::t('user', 'Self description'),
            'photo' => Yii::t('user', 'Photo'),
            'country_code' => Yii::t('user', 'Country code'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'value' => function () {
                    return date("Y-m-d H:i:s");
                },
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'create_time',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time',
                ],
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        $user = Yii::$app->getModule("user")->model("User");
        return $this->hasOne($user::className(), ['id' => 'user_id']);
    }

//    public function getPhoto() {
//        return Yii::$app->params['upload.url'] .DIRECTORY_SEPARATOR.
//        $model = \common\models\Files::findOne([
//                    'id' => $this->photo,
//                    'description' => 'photo'
//                ])->code;
//    }
    

   public function getPhoto(){
       return Yii::$app->params['upload.url'] .DIRECTORY_SEPARATOR.
            $this->hasOne('\common\models\Files', ['id'=>'photo'])->one()->code;
   }

    /**
     * Set user id
     *
     * @param int $userId
     * @return static
     */
    public function setUser($userId) {
        $this->user_id = $userId;
        return $this;
    }

}
