<?php

namespace common\models;

use Yii;
use common\models\queries\TicketCommetsQuery;

/**
 * This is the model class for table "ticket_comments".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $ticket_id
 * @property string $text
 * @property integer $status
 * @property string $date
 * @property integer $answer_to
 *
 * @property Ticket $ticket
 * @property User $user
 */
class TicketComments extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_READ = 1;
    
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
            [['text'], 'required'],
            [['user_id', 'ticket_id', 'status', 'answer_to'], 'integer'],
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
        return $this->hasOne(\common\modules\user\models\User::className(), ['id' => 'user_id']);
    }
    
    /**
     * 
     * @return TicketCommetsQuery
     */
    public static function find() {
        return new TicketCommetsQuery(get_called_class());
    }
}
