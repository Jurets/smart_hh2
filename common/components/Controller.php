<?php
/* Frontend Special Controller */
namespace common\components;

use Yii;
use yii\web\Controller as native_Controller;
use common\modules\user\models\User;
use yii\helpers\Url;
use common\modules\user\models\Role;

class Controller extends native_Controller {

    // this need for build redirect action (default is module user action default 'user')
    public $redirectController;
    
    protected $Usr; // current record of user
    protected $Role; // current role of this user

    /* key - roles (4) values - string: 
     * enumeration of actions to access wth this role. All - enabled for All actions
     * for deny without redirect just not sign action:
     * 'Guest' => 'index view', - action create deny with system message
     *  but for deny with redirect - sign needed action with specifig redirection signature:
     * for example: in Guest section - 'Guest' => 'index view create-toLogin':
     * index and view - enable to access, but create disable with redirect to action login.
     * 
     * */
    protected $access_convension = [
        'Admin' => 'All',
        'Customer' => 'All',
        'Performer' => 'All',
        'Guest' => 'All',
    ];

    public function convensionInit() {
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
        $this->access_convension = array_merge($this->access_convension, $this->convensionInit()); // You may override this function in your child controller (see example in the top)
        if (!Yii::$app->user->id) {
            $this->Usr = NULL;
            $this->Role = 'Guest';
        } else {
            $this->Usr = User::find()
                    ->with('role')
                    ->where(['id' => Yii::$app->user->id])
                    ->one();
            $this->Role = $this->Usr->role->name;
            $this->banVerify();
        }
        return TRUE;
    }

    public function beforeAction($action) {
        parent::beforeAction($action);
        $this->redirectController = 'user'; // setup default controller-part for redirect URL
        $this->convensionVerify($action->id);
        // User Activity Control
        UserActivity::updateOnlineDate(Yii::$app->user->id);
        return TRUE;
    }

    protected function banVerify() {
        if ($this->Usr->ban_time !== NULL) {
            Yii::$app->user->logout();
            throw new \yii\web\HttpException('403', 'Permission denied ban reason');
        }
    }

    protected function convensionVerify($action) {
        // TO DO - интеграция возможности редиректа вместо вывода стандартного сообщения
        $extract = $this->access_convension[$this->Role];
        if ($extract === 'All') {
            return TRUE; // full access
        }
        
        if (strpos($extract, $action) === FALSE) {
            throw new \yii\web\HttpException('403', 'Permission denied are not allowed to view the page');
        }else{
            if (strpos($extract, '->') !== FALSE) {
                $this->accessDeniedWithRedirect($extract, $action);
            }
            $this->accessRetification($extract, $action);
        }
        
        return TRUE;
    }
    /* more strict access verifycation */
    protected function accessRetification($extract, $action){
        $buff = explode(' ', $extract);
        if(array_search($action, $buff) === FALSE){
           throw new \yii\web\HttpException('403', 'Permission denied are not allowed to view the page'); 
        }
        
    }
    /* provide redirect for action-toUrl */
    protected function accessDeniedWithRedirect($extract, $action){
        $items = explode(' ', $extract);
                foreach ($items as $item) {
                    if (strpos($item, '->') === FALSE) {
                        continue;
                    } else {
                        $buff = explode('->', $item);
                        $targetAction = $buff[0];
                        if ($targetAction === $action) {
                            $redirectTo = strtolower(substr($buff[1], 2));
                            if (Yii::$app->urlManager->enablePrettyUrl === TRUE) {
                                $this->redirect(Url::to('/'.$this->redirectController.'/'.$redirectTo), TRUE);
                            }
                            $this->redirect(Url::to('/?r='.$this->redirectController.'/'.$redirectTo), TRUE);
                        }
                    }
                }
    }

}
