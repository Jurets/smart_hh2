<?php

namespace common\components;

use Yii;
use common\modules\user\models\Profile;

class UserActivity {
    /* Component services */
    
    public static function OnlineMessageProcess($id) {
        $obj = new UserActivity($id);
        return $obj->checkOnlineOrOffline();
    }

    public static function SetupOnlineProfileParam($id) {
        $obj = new UserActivity($id);
        $obj->updateProfileOnline();
    }

    public static function RegisterUserLineStatus($id, $command) {
        $commands = ['on' => 1, 'off' => 0];
        $obj = new UserActivity($id);
        $obj->makelineStatus($commands[$command]);
    }

    /* Functionality */

    public $userId; // user DB-identifier
    public $onlineMinutes; // how much minutes when user considered as online
    private $userProfile; // model object of user profile
    private $userCondition; // means params: online & online_status
    private $currentTimestamp;

    public function __construct($id, $onlineMinutes = 10) {
        $this->userId = (int) $id;
        $this->userProfile = Profile::findOne(['user_id'=>$this->userId]);
        $this->userCondition = [];
        $this->setupOnlineParams();
        $this->onlineMinutes = (int) $onlineMinutes;
        $this->currentTimestamp = date('Y-m-d H:i:s');
    }

    /* временный метод, модифицировать, когда будут пройдены тесты */

    private function setupOnlineParams() {
          $this->userCondition['online'] = $this->userProfile->online;
          $this->userCondition['online_status'] = $this->userProfile->online_status;
    }

    /* еще один временный метод */

    public function updateProfileOnline() {
          $this->userProfile->online = $this->currentTimestamp;
          $this->userProfile->save();
    }

    public function checkOnlineOrOffline() {
        $timeDifferent = $this->translateDateTimeToSeconds($this->currentTimestamp) - $this->translateDateTimeToSeconds($this->userCondition['online']);
        if ((int) $this->userCondition['online_status'] === 1) {
            if ($timeDifferent <= ($this->onlineMinutes * 60)) {
                return Yii::t('app','online');
            }
        }
        return $this->formatter($timeDifferent);
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

    private function formatter($inputing) {
        $seconds = $inputing;
        $minutes = $inputing / 60;
        $hours = $inputing / (60 * 60);
        $days = $inputing / (60 * 60 * 24);
        if ($days >= 1) {
            return Yii::t('app','Was online').' '.(int) $days.' '.Yii::t('app', 'days ago');
        } else if ($hours >= 1) {
            return Yii::t('app','Was online').' '.(int) $hours.' '.Yii::t('app', 'hours ago');
        } else if ($minutes >= 1) {
            return Yii::t('app','Was online').' '.(int) $minutes.' '.Yii::t('app', 'minutes ago');
        } else {
            return Yii::t('app','Was online').' '.(int) $seconds.' '.Yii::t('app', 'seconds ago');
        }
    }

    /* и еще один метод */
    /* switch user_status field between 1 - online and 0 - offline */

    public function makelineStatus($switcher) {
          $this->userProfile->online_status = $switcher;
          $this->userProfile->save();
    }

}
