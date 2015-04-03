<?php

namespace common\models;

use Yii;

use yii\web\UploadedFile;

/**
 * This is the model class for table "slider".
 *
 * @property integer $id
 * @property string $picture
 * @property string $title
 */
class Slider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slider';
    }

    public $file_prepare; // file uploads container
    public $old_file;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_prepare'], 'file', 'extensions' => 'jpg,jpeg, png, gif', 'mimeTypes' => 'image/jpeg, image/png, image/gif'],
            [['picture'], 'required'],
            [['picture', 'title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'picture' => Yii::t('app', 'Picture'),
            'title' => Yii::t('app', 'Title'),
        ];
    }
    public function returnUrl(){
        return Yii::$app->params['upload.path'] . DIRECTORY_SEPARATOR . $this->picture;
    }
    public function beforeDelete() {
        parent::beforeDelete();
        $this->fileAutoRemover();
        return TRUE;
    }
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        $this->pictureUploader();
        return TRUE;
    }

    /* picture uploads */
    public function picturePrepare() {
        $this->file_prepare = UploadedFile::getInstanceByName('picture');
        $this->picture = $this->getUniqName($this->file_prepare->baseName) .
                '.' . $this->file_prepare->extension;
    }
    protected function getUniqName($addition) {
        $str = date('d.m.Y H:i:s') . $addition;
        $hash_arr = str_split(md5($str), 1);
        shuffle($hash_arr);
        $name = join('', $hash_arr);
        return 'slider_' . substr($name, 0, 20);
    }
    protected function pictureUploader() {
        if (!is_null($this->file_prepare)){
            $this->file_prepare->saveAs(Yii::$app->params['upload.path'] . DIRECTORY_SEPARATOR . $this->picture);
        }
    }
    protected function fileAutoRemover(){
        if(file_exists(Yii::$app->params['upload.path'] . DIRECTORY_SEPARATOR . $this->picture)){
            unlink(Yii::$app->params['upload.path'] . DIRECTORY_SEPARATOR . $this->picture);
        }
        if(file_exists($this->old_file)){
            unlink(Yii::$app->params['upload.path'] . DIRECTORY_SEPARATOR . $this->old_file);
        }
    }
}
