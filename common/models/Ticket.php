<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticket".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $id_category
 * @property string $description
 * @property string $title
 * @property integer $price
 * @property string $created
 * @property integer $is_turned_on
 * @property string $system_key
 * @property integer $status
 * @property integer $is_time_enable
 * @property string $start_day
 * @property string $finish_day
 * @property string $comment
 * @property integer $is_positive
 * @property integer $rate
 *
 * @property Category $category
 * @property User $user
 */
class Ticket extends \yii\db\ActiveRecord
{

    // Field is_turned_on 
    const TICKET_TURNED_OFF = 0;
    const TICKET_TURNED_ON = 1;
    
    //Field status
    const TICKET_STATUS_COMPLETED = 0;
    const TICKET_STATUS_EXPIRED = 1;
    const TICKET_STATUS_PROCESSING = 2;
    const TICKET_STATUS_NOT_COMPLETED = 3;
    
    //Field is_time_enable
    const TICKET_STATUS_TIME_OFF = 0;
    const TICKET_STATUS_TIME_ON = 1;
    
    
    const TICKET_WITHOUT_COMMENT = 0;
    const TICKET_WITH_COMMENT = 1;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'id_category', 'description', 'title', 'is_turned_on', 'is_time_enable'], 'required'],
            [['user_id', 'id_category', 'price', 'is_turned_on', 'status', 'is_time_enable', 'is_positive', 'rate'], 'integer'],
            [['description', 'comment'], 'string'],
            [['created', 'start_day', 'finish_day'], 'safe'],
            [['title', 'system_key'], 'string', 'max' => 255]
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
            'id_category' => Yii::t('app', 'Id Category'),
            'description' => Yii::t('app', 'Description'),
            'title' => Yii::t('app', 'Title'),
            'price' => Yii::t('app', 'Price'),
            'created' => Yii::t('app', 'Created'),
            'is_turned_on' => Yii::t('app', 'Is Turned On'),
            'system_key' => Yii::t('app', 'System Key'),
            'status' => Yii::t('app', 'Status'),
            'is_time_enable' => Yii::t('app', 'Is Time Enable'),
            'start_day' => Yii::t('app', 'Start Day'),
            'finish_day' => Yii::t('app', 'Finish Day'),
            'comment' => Yii::t('app', 'Comment'),
            'is_positive' => Yii::t('app', 'Is Positive'),
            'rate' => Yii::t('app', 'Rate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
