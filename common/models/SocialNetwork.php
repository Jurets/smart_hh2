<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "social_network".
 *
 * @property integer $id
 * @property string $title
 * @property string $icon
 *
 * @property UserSocialNetwork[] $userSocialNetworks
 * @property User[] $users
 */
class SocialNetwork extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'social_network';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'icon'], 'required'],
            [['title', 'icon'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'icon' => Yii::t('app', 'Icon'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSocialNetworks()
    {
        return $this->hasMany(UserSocialNetwork::className(), ['social_network_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_social_network', ['social_network_id' => 'id']);
    }
}
