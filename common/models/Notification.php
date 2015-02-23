<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $message
 * @property string $link
 * @property string $type
 * @property string $date
 * @property integer $is_read
 * @property string $entity
 * @property integer $entity_id
 *
 * @property User $user
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'message', 'link', 'type'], 'required'],
            [['user_id', 'is_read', 'entity_id'], 'integer'],
            [['date'], 'safe'],
            [['message', 'link'], 'string', 'max' => 512],
            [['type', 'entity'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'message' => Yii::t('app', 'Message'),
            'link' => Yii::t('app', 'Link'),
            'type' => Yii::t('app', 'Type'),
            'date' => Yii::t('app', 'Date'),
            'is_read' => Yii::t('app', 'Is Read'),
            'entity' => Yii::t('app', 'Entity'),
            'entity_id' => Yii::t('app', 'Entity ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
