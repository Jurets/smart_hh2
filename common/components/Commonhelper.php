<?php

namespace common\components;

class Commonhelper {
    /* year quantity for Html::dropDownList */

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

    /* date/time conversion methods block */

    public static function checkDeadline($finish_day) {
        $o = new Commonhelper;
        $finish_day_clear = explode(' ', $finish_day)[0];
        $onTicket = $o->timestampToSeconds($finish_day_clear.' 00:00:00');
        $now = $o->timestampToSeconds(date('Y-m-d'.' 00:00:00'));
        $diffSec = $onTicket - $now;
        if($diffSec <= 0 ){
            return 0;
        }
        $days = $diffSec / 3600 / 24;
        return $days;
    }
    public static function convertDate($timestamp=NULL, $mode=1){
        $o = new Commonhelper;
        if(is_null($timestamp) || empty($timestamp)){
            return NULL;
        }
        $seconds = $o->timestampToSeconds($timestamp);
        switch($mode){
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
