<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "language".
 *
 * @property integer $id
 * @property string $name
 *
 * @property UserLanguage[] $userLanguages
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'language';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Language Title'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLanguages()
    {
        return $this->hasMany(UserLanguage::className(), ['language_id' => 'id']);
    }

    /* return an array all determine system languages (with native names from common\config\params.php) */
    public static function getExistLanguagesArray(){
        $basis = new Language;
        $language_models =  $basis->find('id <> 0')->all();
        $languages = [];
        foreach ($language_models as $model){
            $languages[$model->id] = $model->name;
        }
        return $languages;
    }

    public static function getOptionLanguagesArray($langIds){
        $langIds = is_array($langIds) ? implode(',', $langIds) : $langIds;
        $language_models =  self::find()->where("id NOT IN ($langIds)")->all();
        $languages = [];
        foreach ($language_models as $model){
            $languages[] = ['id' => $model->id, 'name' => $model->name];
        }
        return $languages;
    }
}
