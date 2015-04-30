<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_beforeregister".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $stage
 * @property string $date
 * @property string $code
 * @property integer $completed
 *
 * @property User $user
 */
class UserBeforeregister extends \yii\db\ActiveRecord
{
    /*
     * consstants
     */
    const STAGE_OPEN = 0;
    const STAGE_CLOSE = 1;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_beforeregister';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'stage', 'completed'], 'integer'],
            [['date'], 'safe'],
            [['code'], 'string', 'max' => 255]
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
            'stage' => Yii::t('app', 'Stage'),
            'date' => Yii::t('app', 'Date'),
            'code' => Yii::t('app', 'Code'),
            'completed' => Yii::t('app', 'Completed'),
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
