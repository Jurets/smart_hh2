<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

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
    public $file; // single upload actions
    public $files = []; // multy upload actions

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
            //if ($this->file->saveAs(\Yii::$app->params['upload.path'] . $code . '.' . $extension) !== false) {
            if ($this->file->saveAs(self::getUploadPath() . $code . '.' . $extension) !== false) {
                $this->save();
            }
        }
        //return file_id, use it to save foreign key
       return $this->id;
        
    }
    
    public function saveSingleImage($user_id, $description='photo', $instance='photo'){
        if(empty($user_id)){
            throw new \yii\web\HttpException("Invalid user id for \common\models\files  saveSingleImage method");
        }
        $this->file = UploadedFile::getInstanceByName($instance);
        
        $this->name = $this->file->baseName;
        $this->size = $this->file->size;
        $this->code = $this->_getRandomName($this->file->baseName);
        $this->mimetype = $this->file->type;
        $this->description = $description;
        $this->user_id = $user_id;
        if($this->validate()){
            if($this->file->saveAs(self::getUploadPath().$this->code.'.'.$this->file->extension)){
                $this->save(false);
                return $this->id;
            }
        }
        throw new \yii\web\HttpException($description." uploaded are not success");
    }
    
    public function saveMultyImage($user_id, $description='photo', $instance='photo'){
        if(empty($user_id)){
            throw new \yii\web\HttpException("Invalid user id for \common\models\files  saveMultyImage method");
        }
        $file_ids = [];
        $this->files = UploadedFile::getInstancesByName($instance);
        foreach($this->files as $file){
            $model = new Files;
            $model->name = $file->baseName;
            $model->size = $file->size;
            $model->code = $this->_getRandomName($file->baseName);
            $model->mimetype = $file->type;
            $model->description = $description;
            $model->user_id = $user_id;
            if($model->validate()){
                if($file->saveAs(self::getUploadPath().$model->code.'.'.$file->extension)){
                    $model->save(false);
                    $file_ids[] = $model->id;
                    unset($model);
                }else{
                    throw new \yii\web\HttpException('saveMultyImage terminated: save image failure: '.$model->code.' '.$model->name);
                }
            }else{
                throw new \yii\web\HttpException('saveMultyImage terminated: image validation failure: '.$model->code.' '.$model->name);
            }
        }
        return $file_ids;
    }
    
    /*
     * Generate random string for name file
     */
    private function _getRandomName($filename)
    {
        $filenamehash = md5(time() . $filename);
        return $filenamehash;
    }

    /**
    * 
    */
    public function getFilePath() {
        //$exts = FileHelper::getExtensionsByMimeType($this->mimetype);
        return self::getUploadPath() . $this->_baseName();
        //return self::getUploadPath() . $this->code . '.' . $exts[0];
    }   
    
    /**
    * вернуть URL картинки
    * 
    * @param mixed $fileName - имя файла (без пути естесно))
    * @param mixed $default - файл по дефолту, если $fileName не найден
    * @return CAttributeCollection
    */
    public function getFileUrl() {
        //путь к хранилищу файлов (из настроек)
        /*$dir = isset(Yii::app()->params['upload.path']) ? Yii::app()->params['upload.path'] : self::DEFAULT_PATH;
        //базовый урл (из настроек)
        $url = isset(Yii::app()->params['upload.url']) ? Yii::app()->params['upload.url'] : self::DEFAULT_PATH;
        if (is_file($dir . DIRECTORY_SEPARATOR . $fileName))
            return $url . basename($fileName);  
        else { //если файл не найден - вернуть дефолтное фото
            if (!empty($default)) {
                if (is_file($default))
                    return $default;
                else if (is_file($dir . DIRECTORY_SEPARATOR . $default))
                    return $dir . DIRECTORY_SEPARATOR . $default;
            }
            return isset(Yii::app()->params['photo.default']) ? Yii::app()->params['photo.default'] : self::DEFAULT_PHOTO;
        }*/ 
        //DebugBreak();
        //$exts = FileHelper::getExtensionsByMimeType($this->mimetype);
        return Yii::$app->params['upload.url'] . '/' . $this->_baseName();
        //return Yii::$app->params['upload.url'] . '/' . $this->code . '.' . $exts[0];
    }

    /**
    * build base name by code and mimetype
    * 
    */
    private function _baseName() {
        $path = self::getUploadPath();
        //get extensions (http://www.yiiframework.com/doc-2.0/yii-helpers-basefilehelper.html#$mimeMagicFile-detail)
        $exts = FileHelper::getExtensionsByMimeType($this->mimetype);
        foreach ($exts as $ext) {
            //$file = $path . $this->code . '.' . $ext;
            if (is_file($path . $this->code . '.' . $ext))
                return $this->code . '.' . $ext;
        }
        return false;
    }
    
    /**
    *  return path for files uploading
    */
    public static function getUploadPath() {
        return Yii::$app->params['upload.path'] . DIRECTORY_SEPARATOR;
    }

}
