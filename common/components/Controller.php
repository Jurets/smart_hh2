<?php
namespace common\components;

use Yii;
use yii\web\Controller as native_Controller;
use common\modules\user\models\User;
use common\modules\user\models\Role;

class Controller extends native_Controller {
    
    protected $Usr; // current record of user
    protected $Role; // current role of this user
    
    /* key - roles (4) values - string: 
     * enumeration of actions to access wth this role. All - enabled for All actions
     **/
    protected $access_convension = [
            'Admin' => 'All',
            'Customer' => 'All',
            'Performer' => 'All',
            'Guest' => 'All',
    ];
    public function convensionInit(){
        /* example convension overrides */
        return [
//            'Admin' => 'All',
//            'Customer' => 'All',
//            'Performer' => 'All',
//            'Guest' => 'All',
        ];
    }
	/* use undepended user ban simple verifycation */
    public function init() {
	parent::init();
         $this->access_convension = 
                array_merge($this->access_convension,
                        $this->convensionInit()); // You may override this function in your child controller (see example in the top)
        if(!Yii::$app->user->id){
            $this->Usr = NULL;
            $this->Role = 'Guest';
        }
        else{
           $this->Usr = User::find()
                   ->with('role')
                   ->where(['id'=>Yii::$app->user->id])
                   ->one();
           $this->Role = $this->Usr->role->name;
           $this->banVerify();
        }
        return TRUE;
    }
    public function beforeAction($action) {
        parent::beforeAction($action);
        $this->convensionVerify($action->id);
        return TRUE;
    }
    protected function banVerify(){
        if($this->Usr->ban_time !== NULL){
            Yii::$app->user->logout();
            throw new \yii\web\HttpException('403', 'Permission denied ban reason');
        }
    }
    protected function convensionVerify($action){
        $extract = $this->access_convension[$this->Role];
        if($extract === 'All'){
            return TRUE; // full access
        }
        if(strpos($extract, $action) === FALSE){
            throw new \yii\web\HttpException('403', 'Permission denied are not allowed to view the page');
        }
    }
}

