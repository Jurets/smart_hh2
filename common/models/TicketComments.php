<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ticket_comments".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $ticket_id
 * @property string $text
 * @property integer $status
 * @property string $date
 *
 * @property Ticket $ticket
 * @property User $user
 */
class TicketComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'ticket_id', 'text'], 'required'],
            [['user_id', 'ticket_id', 'status'], 'integer'],
            [['text'], 'string'],
            [['date'], 'safe']
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
            'ticket_id' => Yii::t('app', 'Ticket ID'),
            'text' => Yii::t('app', 'Text'),
            'status' => Yii::t('app', 'Status'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
