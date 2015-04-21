<?php
namespace common\components;
use Yii;
use yii\base\Widget;
use common\models\Category;

class CabinetWidget extends Widget {
    public $popup; // path to popup window layout
    public $path; // const part of pass to form-layouts
    public $signature = NULL; // for choise who trying to render popup window
    
    private $profile; // user profile from models

    protected $layouts; // render varriants array for cabinet popup window
    protected $dataSet = []; // structure func with data for init popup window forms 
    
    public function init(){
        parent::init();
        $this->profile = Yii::$app->user->identity->profile;
        $this->dataSetVarriantsInit();
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
            'dataSet' => NULL,
            'destinationClass' => NULL
        ];
        $this->layouts['PhotoUploads'] = [
            'title' => Yii::t('app', 'Photo Uploads'),
            'form' => $this->path.'/photo_form',
            'dataSet' => NULL,
            'destinationClass' => 'pop-up-change_photo',
        ];
        $this->layouts['HourlyRate'] = [
            'title' => Yii::t('app', 'Hourly Rate'),
            'form' => $this->path.'/hourly_rate_form', // popup content section
            'dataSet' => $this->dataSet['HourlyRate'](), // data structure to popup content section for empty forms is NULL othervice $this->dataSet accross defaultController
            'destinationClass' => NULL,
        ];
        
        $this->layouts['english'] = [
            'title' => Yii::t('app', 'English'),
            'form' => $this->path.'/english_form',
            'dataSet' => $this->dataSet['English'](),
            'destinationClass' => 'pop-up-english',
        ];
        $this->layouts['russian'] = [
            'title' => Yii::t('app', 'Russian'),
            'form' => $this->path.'/russian_form',
            'dataSet' => $this->dataSet['Russian'](),
            'destinationClass' => 'pop-up-english',
        ];
        $this->layouts['AdressMailing'] = [
            'title' => Yii::t('app', 'Address Mailing'),
            'form' => $this->path.'/mailing_form',
            'dataSet' => $this->dataSet['AdressMailing'](),
            'destinationClass' => 'pop-up-mailing',
        ];
        $this->layouts['Phone'] = [
            'title' => Yii::t('app', 'Phone'),
            'form' => $this->path.'/phone_form',
            'dataSet' => $this->dataSet['Phone'](),
            'destinationClass' => 'pop-up-phone',
        ];
        $this->layouts['BillingAddress'] = [
            'title' => Yii::t('app','Address Billing'),
            'form' => $this->path.'/billing_form',
            'dataSet' => $this->dataSet['BillingAddress'](),
            'destinationClass' => 'pop-up-billing',
        ];
        $this->layouts['PayeeProfile'] = [
             'title' => Yii::t('app', 'Payee Details'),
             'form' => $this->path.'/payee_profile_form',
             'dataSet' => $this->dataSet['PayeeProfile'](),
             'destinationClass' => 'pop-up-payment-profile', // temporary
        ];
        $this->layouts['Specialites'] = [
             'title' => Yii::t('app', 'Specialties'),
             'form' => $this->path.'/specialites_form',
             'dataSet' => $this->dataSet['Specialites'](),
             'destinationClass' => 'popup-specialites',
        ];
        $this->layouts['Diploma'] = [
            'title' => Yii::t('app', 'Diplomas'),
            'form' => $this->path.'/diploma_form',
            'dataSet' => NULL,
            'destinationClass' => 'pop-up-diploma',
        ];
        $this->layouts['Verid'] = [
            'title' => Yii::t('app', 'Verification Docs'),
            'form' => $this->path.'/verid_form',
            'dataSet' => NULL,
            'destinationClass' => 'pop-up-verid',
        ];
    }
    protected function dataSetVarriantsInit(){
        $this->dataSet['HourlyRate'] = function(){
          return $this->profile->hourly_rate;
        };
        $this->dataSet['English'] = function(){
            $userId = $this->profile->user_id;
            $language = \common\models\UserLanguage::find()
                    ->where([
                        'user_id'=>$userId,
                        'language_id' => 1,
                    ])->one();
            return (!is_null($language)) ? $language->knowledge : NULL;
        };
        $this->dataSet['Russian'] = function(){
          $language = \common\models\UserLanguage::find()
                  ->where([
                      'user_id' => $this->profile->user->id,
                      'language_id' => 2,
                  ])->one();
          return (!is_null($language)) ? $language->knowledge : NULL;
        };
        $this->dataSet['AdressMailing'] = function(){
            return $this->profile->adress_mailing;
        };
        $this->dataSet['Phone'] = function(){
            return $this->profile->phone;
        };
        $this->dataSet['BillingAddress'] = function(){
            return $this->profile->adress_billing;
        };
        $this->dataSet['PayeeProfile'] = function(){
            $paymentProfile = \common\models\PaymentProfile::findOne(['user_id'=>$this->profile->user->id]);
            if(is_null($paymentProfile)){
                $paymentProfile = new \common\models\PaymentProfile;
            }
            return $paymentProfile;
            
        };
        $this->dataSet['Specialites'] = function(){
            $category = new Category;
            return $category->userCategoriesOutput();
        };
    }
}
?>