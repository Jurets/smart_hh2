<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_language".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $language_id
 * @property integer $knowledge
 *
 * @property Language $language
 * @property User $user
 */
class UserLanguage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_language';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'language_id', 'knowledge'], 'required'],
            [['user_id', 'language_id', 'knowledge'], 'integer']
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
            'language_id' => Yii::t('app', 'ИД языка'),
            'knowledge' => Yii::t('app', 'уровень владения (от 1 до 5)'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
