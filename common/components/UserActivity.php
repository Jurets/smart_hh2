<?php
namespace common\components;
use Yii;
use common\modules\user\models\Profile;
use common\models\Ticket;

class UserActivity {
    /* Component services */
    
    /* get online-offline standard format message */
    public static function NetworkStatus($id) {
        $obj = new UserActivity($id);
        if(!$obj->validateService()){return 0;}
        return $obj->checkOnlineOrOffline();
    }
    
    /* get how a long last ticket done */
    public static function lastDoneTask($id){
        $obj = new UserActivity($id);
        $query = Ticket::find()
                ->where(['performer_id' => $id, 'status'=>Ticket::STATUS_COMPLETED])
                ->orderBy(['updated_at'=>SORT_DESC])
                ->limit(1);
        $date = $query->one();
        if(is_null($date)){
            return NULL;
        }
        return $obj->checkLastDoneTask($date->updated_at);
    }

    /* update online time (online) */
    public static function updateOnlineDate($id) {
        $obj = new UserActivity($id);
        if(!$obj->validateService()){return 0;}
        $obj->updateProfileOnline();
    }

    /* change online_status over commands: on/off (1/0)  */
    public static function changeNetworkStatus($id, $command) {
        $commands = ['on' => 1, 'off' => 0];
        $obj = new UserActivity($id);
        if(!$obj->validateService()){return 0;}
        $obj->makelineStatus($commands[$command]);
    }

    /* Functionality */

    public $userId; // user DB-identifier
    public $onlineMinutes; // how much minutes when user considered as online
    private $userProfile; // model object of user profile
    private $userCondition; // means params: online & online_status
    private $currentTimestamp;

    public function __construct($id, $onlineMinutes = NULL) {
        if(is_null($onlineMinutes)){
            $onlineMinutes = Yii::$app->params['user.minutes.considered.online'];
        }
        $this->userId = (int) $id;
        $this->userProfile = Profile::findOne(['user_id'=>$this->userId]);
        $this->userCondition = [];
        $this->setupOnlineParams();
        $this->onlineMinutes = (int) $onlineMinutes;
        $this->currentTimestamp = date('Y-m-d H:i:s');
    }
    public function validateService(){
        if ($this->userId === 0) {
            return FALSE;
        }
        return TRUE;
    }
    /*  */
    private function setupOnlineParams() {
          if($this->userId === 0){
              return 0;
          }
          $this->userCondition['online'] = $this->userProfile->online;
          $this->userCondition['online_status'] = $this->userProfile->online_status;
    }

    /*  */

    public function updateProfileOnline() {
          $this->userProfile->online = $this->currentTimestamp;
          $this->userProfile->save();
    }

    public function checkOnlineOrOffline() {
        $timeDifferent = $this->translateDateTimeToSeconds($this->currentTimestamp) - $this->translateDateTimeToSeconds($this->userCondition['online']);
        if ((int) $this->userCondition['online_status'] === 1) {
            if ($timeDifferent <= ($this->onlineMinutes * 60)) { // *60 - features mast be in minutes - translated into seconds automatically
                return Yii::t('app','online');
            }
        }
        return $this->formatter($timeDifferent);
    }

    public function checkLastDoneTask($dateTimestampFromTicket){
        $timeDifferent = 
                $this->translateDateTimeToSeconds($this->currentTimestamp) - 
                $this->translateDateTimeToSeconds($dateTimestampFromTicket);
        return $this->formatter($timeDifferent, 'ticket');
    }
    
    /* addition method to $this->different() */

    private function translateDateTimeToSeconds($timestamp) {
        $major = explode(' ', $timestamp);
        $minor_left = explode('-', $major[0]);
        $minor_right = explode(':', $major[1]);

        $year = (int) $minor_left[0];
        $month = (int) $minor_left[1];
        $day = (int) $minor_left[2];

        $hour = (int) $minor_right[0];
        $minute = (int) $minor_right[1];
        $second = (int) $minor_right[2];

        $seconds = mktime($hour, $minute, $second, $month, $day, $year);

        return $seconds;
    }

    /* addition 2 answer formatter */

    private function formatter($inputing, $mode='user' /* or ticket*/) {
        if($mode === 'user'){
            $tail = Yii::t('app','Was online');
        }else{
            $tail = Yii::t('app','Latest task done');
        }
        
        $seconds = $inputing;
        $minutes = $inputing / 60;
        $hours = $inputing / (60 * 60);
        $days = $inputing / (60 * 60 * 24);
        if ($days >= 1) {
            return $tail.' '.(int) $days.' '.Yii::t('app', 'days ago');
        } else if ($hours >= 1) {
            return $tail.' '.(int) $hours.' '.Yii::t('app', 'hours ago');
        } else if ($minutes >= 1) {
            return $tail.' '.(int) $minutes.' '.Yii::t('app', 'minutes ago');
        } else {
            return $tail.' '.(int) $seconds.' '.Yii::t('app', 'seconds ago');
        }
    }

    /* и еще один метод */
    /* switch user_status field between 1 - online and 0 - offline */

    public function makelineStatus($switcher) {
          $this->userProfile->online_status = $switcher;
          $this->userProfile->save();
    }

}
