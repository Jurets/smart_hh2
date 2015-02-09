<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_social_network".
 *
 * @property integer $social_network_id
 * @property integer $user_id
 * @property string $url
 * @property integer $moderate
 *
 * @property User $user
 * @property SocialNetwork $socialNetwork
 */
class UserSocialNetwork extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_social_network';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['social_network_id', 'user_id', 'url'], 'required'],
            [['social_network_id', 'user_id', 'moderate'], 'integer'],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'social_network_id' => Yii::t('app', 'Social Network ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'url' => Yii::t('app', 'Url'),
            'moderate' => Yii::t('app', 'Moderate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialNetwork()
    {
        return $this->hasOne(SocialNetwork::className(), ['id' => 'social_network_id']);
    }
}
