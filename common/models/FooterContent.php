<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "footer_content".
 *
 * @property integer $id
 * @property string $title
 * @property integer $lang
 * @property string $reference
 * @property integer $img
 *
 * @property GraphicPublishes $img0
 * @property Language $lang0
 */
class FooterContent extends \yii\db\ActiveRecord
{
    /* varriant for rendering list (replace) */
    public $renderVarriants = [
        'Instant help in a click',
        'social network',
        'About Us',
        'FAQ',
        'Terms & Agreement',
        'Contact US',
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'footer_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lang', 'img', 'title'], 'required'],
            [['lang', 'img'], 'integer'],
            [['title', 'reference'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'lang' => Yii::t('app', 'Lang'),
            'reference' => Yii::t('app', 'Reference'),
            'img' => Yii::t('app', 'Img'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImg0()
    {
        return $this->hasOne(GraphicPublishes::className(), ['id' => 'img']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLang0()
    {
        return $this->hasOne(Language::className(), ['id' => 'lang']);
    }
    public function getLanguagesArray(){
        $languages = Language::find()->all();
        $langArray = [];
        foreach($languages as $language){
            $langArray[$language->id] = $language->name;
        }
        return $langArray;
    }
    public function getImagesArray(){
        $images = GraphicPublishes::find()->all();
        $imagesArray = [];
        foreach($images as $image){
            $imagesArray[$image->id] = $image->image;
        }
        return $imagesArray;
    }
}
