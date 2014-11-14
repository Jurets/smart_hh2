<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_verification".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $file_id
 */
class UserVerification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_verification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'file_id'], 'required'],
            [['user_id', 'file_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'ИД юзера'),
            'file_id' => Yii::t('app', 'ИД файла (картинки)'),
        ];
    }
    
    /*
     * performers registration process to attach user_id and file_id into verifycation table
     * static method: need user_id anyway from outside and files id`s as array
     */
    public static function VerifycationAttachmentProcess($user_id, $idArray = array()){
        if(is_null($user_id)){
            throw new \yii\web\HttpException("VerifycationAttachmentProcess failure: unknown user_id");
        }
        if(empty($idArray)){return 'Array of files id are exists?';}
        foreach($idArray as $id){
            $model = new UserVerification;
            $model->setAttributes(['user_id'=>$user_id, 'file_id'=>$id]);
            if(!$model->save()){
                throw new \yii\web\HttpException("VerifycationAttachmentProcess failure: can`t create a new record in database");
            }
        }
    }
}
