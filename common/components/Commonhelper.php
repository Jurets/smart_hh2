<?php
namespace common\components;

class Commonhelper {
    /* year quantity for Html::dropDownList */
    public static function YearList($firstYear, $lalstYear){
        $years = [''=>''];
        $begin_int = (int)$firstYear;
        $end_int = (int)$lalstYear;
        for($i = $begin_int; $i <= $end_int; $i++){
            $years[$i] = $i; 
        }
        return $years;
    }
    public static function MonthList(){
        $month = [''=>''];
        for($i = 1; $i <= 12; $i++){
            $month[$i] = $i;
        }
        return $month;
    }
}
