<?php

namespace common\models;

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
    // bann (is turned on check)
    // Field is_turned_on 
    const TURNED_OFF = 0;
    const TURNED_ON = 1;
    
    //Field status
    const STATUS_COMPLETED = 0;
    const STATUS_EXPIRED = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_NOT_COMPLETED = 3;
    const STATUS_COMPLETED_WITH_COMMENT = 4;
    
    //Field is_time_enable
    const STATUS_TIME_OFF = 0;
    const STATUS_TIME_ON = 1;
    
    
    const WITHOUT_COMMENT = 0;
    const WITH_COMMENT = 1;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket';
    }

    /* serves as a substitute for native values comfy  (Extensible) */
    protected $surrogateStruct = [
        'is_turned_on' => [
            self::TURNED_OFF => 'Banned',
            self::TURNED_ON => 'Active',
        ],
        'status' => [
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_EXPIRED => 'Expired',
            self::STATUS_PROCESSING => 'In processing',
            self::STATUS_NOT_COMPLETED => 'Not Completed',
            self::STATUS_COMPLETED_WITH_COMMENT => 'Completed and comment exist',
        ],
        'is_time_enable' => [
            self::STATUS_TIME_OFF => 'Without execution time',
            self::STATUS_TIME_ON => 'With execution time',
        ],
    ];
    /* invertor bann/unbann */
    public function bannManager(){
        $this->is_turned_on = ($this->is_turned_on === self::TURNED_OFF) ? self::TURNED_ON : self::TURNED_OFF;
    }
    /* for check bann status in view */
    public function isBanned(){
        return ($this->is_turned_on === self::TURNED_OFF) ? TRUE : FALSE;
    }
    /* (statament:1) handling for surrogateStruct */
    public function getIsTurnedOn(){
        return (!is_null($this->is_turned_on)) ? $this->surrogateStruct['is_turned_on'][(int)$this->is_turned_on] : '';
    }
    public function getStatus(){
        return (!is_null($this->status)) ? $this->surrogateStruct['status'][(int)$this->status] : '';
    }
    public function getIsTimeEnable(){
        return (!is_null($this->is_time_enable)) ? $this->surrogateStruct['is_time_enable'][(int)$this->is_time_enable] : '';
    }
    // Available get the surrogateStruct section (particulary once)
    public function surrogateStructSectionReader($section='is_turned_on', $first_empty = false){
       $options = [];
       if(isset($this->surrogateStruct[$section])){
           if($first_empty !== false){
               $options[NULL] ='';
           }
           $options = array_merge($options, $this->surrogateStruct[$section]);
       }
       return $options;
    }
    /* end of statament:1 */
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
            'user_id' => Yii::t('app', 'User'),
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
    public function getUpdateStatuses(){
        return Offer::getTicketStatusUpdate();
    }
    public function getActiveTickets(){
        return $this->find()->where(['performer_id'=>Yii::$app->user->id, 'status'=>self::STATUS_NOT_COMPLETED])->all();
        //return $this->find()->where(['performer_id'=>1])->all();
    }
}
