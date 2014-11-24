<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile|Null file attribute
     */
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'parent_id', 'level', 'weight', 'active'], 'integer'],
            [['name', 'picture'], 'string', 'max' => 255],

            [['file'], 'file'],
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
            'parent_id' => Yii::t('app', 'ParentId'),
            'level' => Yii::t('app', 'Level'),
            'picture' => Yii::t('app', 'Picture'),
            'weight' => Yii::t('app', 'Weight'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /* Category standard Output */
    public function categoryOutput($id){
        $query = self::find();
           $query->onCondition(['level'=> 1]);
           $categories = $query->all();
           if(!is_null($id)){
               $categories['subcategories'] = self::findAll([
                   'parent_id' => (int)$id,
               ]);
           }
        return $categories;
    }
   
}
