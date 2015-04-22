<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_language".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $language_id
 * @property integer $knowledge
 * @property integer $is_native
 *
 * @property Language $language
 * @property User $user
 */
class UserLanguage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_language';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'language_id', 'knowledge', 'is_native'], 'required'],
            [['user_id', 'language_id', 'knowledge'], 'integer'],
            ['is_native', 'boolean'],
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
            'language_id' => Yii::t('app', 'Language ID'),
            'knowledge' => Yii::t('app', 'Knowledge Level (1 to 5)'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function userLanguageImplements($choiseLanguages = array(), $user_id = NULL) {
        if (empty($choiseLanguages) || is_null($user_id)) {
            return false;
        }

        $existLang = UserLanguage::find()->where(['user_id' => $user_id])->all();
            if(!empty($existLang)){
                foreach ($existLang as $lang) {
                    $lang->delete();
                }
            }

        $result = false;
        foreach ($choiseLanguages as $id => $language) {
            if(!$language) break;
            $model = new UserLanguage;
            $model->setAttributes([
                'user_id' => $user_id,
                'language_id' => (int)$language,
            ]);
            if($id === 0){
                $model->is_native = true;
                $model->knowledge = 5;
            } else {
                $model->is_native = false;
                $model->knowledge = 1;
            }
            if($model->save()){
                $result = true;
            }
        }

        return $result;
    }
}
