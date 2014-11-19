<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "complaint".
 *
 * @property integer $id
 * @property integer $ticket_id
 * @property integer $from_user_id
 * @property string $category
 * @property string $message
 * @property integer $status
 *
 * @property User $fromUser
 * @property Ticket $ticket
 */
class Complaint extends \yii\db\ActiveRecord
{
    const STATUS_ON = 1;
    const STATUS_OFF = 0;
    
    /* syspect identity categories */
    const SI_FILTHY_LANGUAGE = 'filthy language';
    const SI_SEXUAL_HARASSMENT = 'sexual harassment';
    const SI_SPAM = 'spam';
    const SI_RACISM = 'racism';
    
    public $complains = array(
        self::SI_FILTHY_LANGUAGE,
        self::SI_SEXUAL_HARASSMENT,
        self::SI_RACISM,
        self::SI_SPAM
    );
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'complaint';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ticket_id', 'from_user_id', 'category', 'message'], 'required'],
            [['ticket_id', 'from_user_id', 'status'], 'integer'],
            [['category', 'message'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ticket_id' => Yii::t('app', 'Ticket ID'),
            'from_user_id' => Yii::t('app', 'From User'),
            'category' => Yii::t('app', 'Category'),
            'message' => Yii::t('app', 'Message'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromUser()
    {
        return $this->hasOne(User::className(), ['id' => 'from_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
    }
    /* suspect list */
    public function getSuspectList(){
        return Complaint::find()
                ->innerJoinWith('ticket')
                ->onCondition(['complaint.status'=>self::STATUS_OFF])
                ->groupBy(['ticket_id'])
                ->having('COUNT(*) >= 3');
    }
    public static function howManyComplains($ticket_id){
        return Complaint::find()
                ->onCondition(['ticket_id'=>$ticket_id, 'status'=>self::STATUS_OFF])
                ->count();
    }
    public static function getTicketComplains($id){
        return Complaint::findAll(['ticket_id'=>$id, 'status'=>self::STATUS_OFF]);
    }
    public function changeStatus($models, $status = self::STATUS_ON){
        foreach($models as $model){
            $model->status = $status;
            $model->save();
        }
    }
}
