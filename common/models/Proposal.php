<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "proposal".
 *
 * @property integer $id
 * @property integer $performer_id
 * @property integer $ticket_id
 * @property string $date
 * @property string $message
 * @property integer $archived
 *
 * @property Ticket $ticket
 * @property User $performer
 */
class Proposal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proposal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['performer_id', 'ticket_id'], 'required'],
            [['performer_id', 'ticket_id', 'archived'], 'integer'],
            [['date'], 'safe'],
            [['message'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'performer_id' => Yii::t('app', 'Performer ID'),
            'ticket_id' => Yii::t('app', 'Ticket ID'),
            'date' => Yii::t('app', 'Date'),
            'message' => Yii::t('app', 'Message'),
            'archived' => Yii::t('app', 'Archived'),
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
    public function getPerformer()
    {
        return $this->hasOne(User::className(), ['id' => 'performer_id']);
    }
}
