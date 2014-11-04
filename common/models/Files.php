<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

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

    /**
     * @var UploadedFile|Null file attribute
     */
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
            [['file'], 'file'],
//            [['name', 'code', 'size'], 'required'],
            [['size', 'user_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 32],
            [['mimetype'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 512]
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

    /*
     * Uploader handler. Save image into the database and
     * return file id which will be saved.
     * Example.
     * view:
     *    echo $form->field($files, 'file')->widget(FileInput::classname(), [
     * This method worls only with single downloading.
            'options' => ['multiple' => false],
            //boolean, whether to show a loading progress indicator in place of the input before plugin is completely loaded. Defaults to true.
            'pluginLoading' => false,
            'pluginOptions' => [
                'showPreview' => true,
                'showCaption' => false,
                'showRemove' => false,
                'showUpload' => false
        ]
    ]);
     */
    public function saveImage($description = "")
    {
        //It  provides information about the uploaded file
        $this->file = UploadedFile::getInstance($this, 'file');
        //Take this information into our variables
        $baseName = $this->file->baseName;
        $extension = $this->file->extension;
        $size = $this->file->size;
        $type = $this->file->type;

        //Folding the model
        $this->name = $baseName;
        $this->size = $size;
        $code = $this->_getRandomName($baseName);
        $this->code = $code;
        $this->mimetype = $type;
        $this->description = $description;
        $this->user_id = Yii::$app->user->id;
        //run validation 
        if ($this->validate()) {
            //If validation is successful, then we're saving the file:
            if ($this->file->saveAs(\Yii::$app->params['defaultFolderForUploads'] . $code . '.' . $extension) !== false) {
                $this->save();
            }
        }
        //return file_id, use it to save foreign key
       return $this->id;
        
    }

    /*
     * Generate random string for name file
     */

    private function _getRandomName($filename)
    {
        $filenamehash = md5(time() . $filename);
        return $filenamehash;
    }

}
