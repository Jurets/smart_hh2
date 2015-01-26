<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_speciality".
 *
 * @property integer $user_id
 * @property integer $category_id
 *
 * @property Category $category
 * @property User $user
 */
class UserSpeciality extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_speciality';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'category_id'], 'required'],
            [['user_id', 'category_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'category_id' => Yii::t('app', 'Category ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getUserSpeciality(){
        $speciality = UserSpeciality::find()
                ->leftJoin('category', 'user_speciality.category_id = category.id')
                ->where('user_speciality.user_id = :uid', [':uid'=>Yii::$app->user->id]);
        return $speciality->all();
    }
}
