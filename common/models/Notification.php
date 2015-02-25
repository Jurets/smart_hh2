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
    const TYPE_BELL_ACCEPTED_BY_OWNER = 'bell_accepted_by_owner';
    const TYPE_BELL_DONE_BY_PERFORMER = 'bell_done_by_performer';
    const TYPE_BELL_FD_UP = 'bell_fd_up';
    const TYPE_BELL_NEW_REVIEW = 'bell_new_review';
    const TYPE_BELL_OFFERED_JOBS = 'bell_offered_jobs';
    const TYPE_BELL_OWNER_OFFERED_NEW_PRICE = 'bell_owner_offered_new_price';
    const TYPE_BELL_PERFORMER_OFFERED_NEW_PRICE = 'bell_performer_offered_new_price';
    const TYPE_BELL_PROPOSAL = 'bell_proposal';
    const TYPE_BELL_ROTTEN = 'bell_rotten';
    
    
    public $proposal_count;
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
    
    public static function find() {
        return new queries\NotificationQuery(get_called_class());
    }
}
