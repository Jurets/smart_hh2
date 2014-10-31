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
}
