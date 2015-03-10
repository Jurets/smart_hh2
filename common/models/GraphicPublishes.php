<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "graphic_publishes".
 *
 * @property integer $id
 * @property string $image
 */
class GraphicPublishes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'graphic_publishes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image' => Yii::t('app', 'Image'),
        ];
    }
}
