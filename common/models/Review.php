<?php

namespace common\models;

use Yii;
use common\modules\user\models\User;
/**
 * This is the model class for table "review".
 *
 * @property integer $id
 * @property integer $from_user_id
 * @property integer $to_user_id
 * @property string $date
 * @property string $message
 * @property integer $rating
 * @property integer $ticket_id
 * 
 * @property User $toUser
 * @property User $fromUser
 * @property Ticket $ticket
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_user_id', 'to_user_id'], 'required'],
            [['from_user_id', 'to_user_id', 'rating', 'ticket_id'], 'integer'],
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
            'from_user_id' => Yii::t('app', 'From User ID'),
            'to_user_id' => Yii::t('app', 'To User ID'),
            'date' => Yii::t('app', 'Date'),
            'message' => Yii::t('app', 'Message'),
            'rating' => Yii::t('app', 'Rating'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToUser()
    {
        return $this->hasOne(User::className(), ['id' => 'to_user_id']);
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
    public function getTicket(){
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
    }
    
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        if($insert){
            $this->setUserProfileRating();
            Yii::$app->notification->addNewReviewNotification($this->to_user_id);
        }
    }
    /* actualised user rating info: rating and voice field */
    protected function setUserProfileRating(){
        $id = $this->to_user_id;
        $ratingSumm = (new \yii\db\Query())
                ->select('sum(rating) ratingSumm')
                ->from('review')
                ->where(['to_user_id'=>$id])
                ->one()['ratingSumm'];
        $ratingCount = (new \yii\db\Query())
                ->select('count(id) ratingCount')
                ->from('review')
                ->where(['to_user_id'=>$id])
                ->one()['ratingCount'];
        $userRating = $ratingSumm / $ratingCount;
        $profile = \common\modules\user\models\Profile::findOne(['user_id' => $id]);
        $profile->rating = (int)$userRating;
        $profile->voice = (int)$ratingCount;
        $profile->save();
    }
}
