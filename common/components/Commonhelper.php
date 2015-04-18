<?php

namespace common\components;

use common\models\Ticket;
use common\models\Zips;
use Yii;

class Commonhelper {
    /* year quantity for Html::dropDownList */

    /* temporary design */

    public static function activeJobsCounter($id) {
        $ticket = Ticket::find()
                ->where(['is_turned_on' => 1])
                ->andWhere(['not', ['status' => Ticket::STATUS_COMPLETED]]);
        $count = $ticket->count();
        return $count;
    }

    public static function YearList($firstYear, $lalstYear) {
        $years = ['' => ''];
        $begin_int = (int) $firstYear;
        $end_int = (int) $lalstYear;
        for ($i = $begin_int; $i <= $end_int; $i++) {
            $years[$i] = $i;
        }
        return $years;
    }

    public static function MonthList() {
        $month = ['' => ''];
        for ($i = 1; $i <= 12; $i++) {
            $month[$i] = $i;
        }
        return $month;
    }

    /* cityes and zip codes return struct for chekbox - temporary design*/
    public static function zipCityStruct() {
        $struct = NULL;
        $data = Zips::find()->all();
        if (!is_null($data)) {
            foreach($data as $elem) {
                $struct[$elem->id] = $elem->city;
            }
        }
        return $struct;
    }

    /* date/time conversion methods block */

    public static function checkDeadline($finish_day) {
        $o = new Commonhelper;
        $finish_day_clear = explode(' ', $finish_day)[0];
        $onTicket = $o->timestampToSeconds($finish_day_clear . ' 00:00:00');
        $now = $o->timestampToSeconds(date('Y-m-d' . ' 00:00:00'));
        $diffSec = $onTicket - $now;
        if ($diffSec <= 0) {
            return 0;
        }
        $days = $diffSec / 3600 / 24;
        return $days;
    }

    public static function convertDate($timestamp = NULL, $mode = 2) {
        $o = new Commonhelper;
        if (is_null($timestamp) || empty($timestamp) || $timestamp == '0000-00-00 00:00:00') {
            return NULL;
        }
        $seconds = $o->timestampToSeconds($timestamp);
        switch ($mode) {
            case 1: // default
                $dateOutput = date('Y-m-d g:i A', $seconds);
                break;
            case 2:
                $dateOutput = date('M d, Y g:i A', $seconds);
                break;
            case 3:
                $dateOutput = date('m/d/Y g:i A', $seconds);
                break;
            default:
                return NULL;
        }
        return $dateOutput;
    }
    // language switch: put into session
    public static function setLanguage($language){
        $session = Yii::$app->session;
        $session['language'] = \yii\helpers\Html::encode($language);
    }
    // language switch: put into session
    public static function getLanguage(){
        $session = Yii::$app->session;
        if(isset($session['language'])){
            return $session['language'];
        }
        return 'en'; // заменить да дефолтный язык из системы после настройки i18n
    }
    /* additionals */

    private function timestampToSeconds($timestamp) {
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

    /* _ */
}
