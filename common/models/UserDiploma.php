<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_diploma".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $file_id
 *
 * @property Files $file
 * @property User $user
 */
class UserDiploma extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_diploma';
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    /*
     * performers registration process to attach user_id and file_id into diploma table
     * static method: need user_id anyway from outside and files id`s as array
     */
    public static function DiplomaAttachmentProcess($user_id, $idArray = array()){
        if(is_null($user_id)){
            throw new \yii\web\HttpException("DiplomaAttachmentProcess failure: unknown user_id");
        }
        if(empty($idArray)){return 'Array of files id are exists?';}
        foreach($idArray as $id){
            $model = new UserDiploma;
            $model->setAttributes(['user_id'=>$user_id, 'file_id'=>$id]);
            if(!$model->save()){
                throw new \yii\web\HttpException("DiplomaAttachmentProcess failure: can`t create a new record in database");
            }
        }
    }
}
