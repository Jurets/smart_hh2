<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $size
 * @property string $mimetype
 * @property string $description
 * @property integer $user_id
 *
 * @property UserDiploma[] $userDiplomas
 */
class Files extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code', 'size'], 'required'],
            [['size', 'user_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 32],
            [['mimetype'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 512],
            [['file'], 'file']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'code' => Yii::t('app', 'Code'),
            'size' => Yii::t('app', 'Size'),
            'mimetype' => Yii::t('app', 'Mimetype'),
            'description' => Yii::t('app', 'Description'),
            'user_id' => Yii::t('app', 'ид юзера владельца'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserDiplomas()
    {
        return $this->hasMany(UserDiploma::className(), ['file_id' => 'id']);
    }
}
