<?php

namespace common\modules\user\models;

use Yii;
use yii\db\ActiveRecord;
use \common\models\Files as Files;

/**
 * This is the model class for table "tbl_profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string  $create_time
 * @property string  $update_time
 * @property string  $full_name
 * @property string  $first_name
 * @property string  $zip_mailing
 * @property string  $zip_billing
 *
 * @property User    $user
 */
class Profile extends ActiveRecord {

    private $photo;
    
    
    public function init() {
        parent::init();
        $this->photo = Yii::$app->params['upload.url'] .DIRECTORY_SEPARATOR.
            $this->hasOne(Files::className(), ['id'=>'photo'])->one();
    }

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
            [['first_name', 'last_name'], 'required', 'on'=>['register']],
            [['full_name'], 'string', 'max' => 255],
            [['first_name'], 'string', 'max' => 255],
            [['last_name'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 64],
            [['phone'], 'match', 'pattern' => '/^\d{3}-\d{3}-\d{4}$/'],
            [['adress_mailing'], 'string', 'max' => 255],
            [['adress_billing'], 'string', 'max' => 255],
            [['paypal'], 'string', 'max' => 64],
            [['another_payment'], 'string', 'max' => 255],
            [['self_description'], 'string', 'max' => 255],
            [['photo'], 'string', 'max' => 255],
            [['country_code'], 'string', 'max' => 255],
            [['hourly_rate'],'double'],
            [['zip_mailing', 'zip_billing'], 'integer'],
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
            'full_name' => Yii::t('user', 'Real Name'),
            //Add new fields:
            'first_name' => Yii::t('app', 'First name'),
            'last_name' => Yii::t('app', 'Last name'),
            'phone' => Yii::t('app', 'Phone'),
            'adress_mailing' => Yii::t('app', 'Adress mailing'),
            'adress_billing' => Yii::t('app', 'Adress billing'),
            'zip_mailing' => Yii::t('app', 'ZIP code mailing'),
            'zip_billing' => Yii::t('app', 'ZIP code billing'),            
            'paypal' => Yii::t('app', 'Paypal'),
            'another_payment' => Yii::t('app', 'Another payment'),
            'self_description' => Yii::t('app', 'Self description'),
            'photo' => Yii::t('app', 'Photo'),
            'country_code' => Yii::t('app', 'Country code'),
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
    
    public function getFiles(){
        return $this->hasOne(\common\models\Files::className(), ['id' => 'photo']);
    }
    
   public function getPhoto(){
       if( !is_null($this->photo) ){
           $result = $this->photo->code;
           return $result;
       }
       return '';
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
    public function updateOnline(){
        $this->online = date('Y:m:d H:i:s');
        $this->save();
        return $this;
    }
    public function beforeSave($insert) {
        $this->full_name = $this->first_name . ' ' . $this->last_name;
        return parent::beforeSave($insert);
    }
}
