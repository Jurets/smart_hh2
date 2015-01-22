<?php
namespace common\components;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Profile;

class CabinetWidget extends Widget {
    public $popup; // path to popup window layout
    public $path; // const part of pass to form-layouts
    
    public $signature = NULL; // for choise who trying to render popup window
    public $dataSet = NULL; // data structure (array) from default controller for initialisation form fields if it is need
    public $destinationClass = NULL; // addition to CSS class for change standard size and popup window offset if it is need
    
    protected $layouts; // render varriants array for cabinet popup window
    
    public function init(){
        parent::init();
        $this->layoutsSetUp();
    }
    public function run(){
        if(isset($this->layouts[$this->signature])) {
            return $this->render($this->popup, [
                        'title' => $this->layouts[$this->signature]['title'],
                        'form' => $this->layouts[$this->signature]['form'],
                        'dataSet' => $this->layouts[$this->signature]['dataSet'],
                        'destinationClass' => $this->layouts[$this->signature]['destinationClass'],
            ]);
        }
        return NULL;
    }
    /*  */
    protected function layoutsSetUp(){
        $this->layouts[NULL] = [
            'title' => NULL,
            'form' => NULL,
            'dataSet' => $this->dataSet,
            'destinationClass' => $this->destinationClass
        ];
        $this->layouts['HourlyRate'] = [
            'title' => Yii::t('app', 'Hourly Rate'),
            'form' => $this->path.'/hourly_rate_form', // popup content section
            'dataSet' => $this->dataSet, // data structure to popup content section for empty forms is NULL othervice $this->dataSet accross defaultController
            'destinationClass' => $this->destinationClass
        ];
    }
}
?>