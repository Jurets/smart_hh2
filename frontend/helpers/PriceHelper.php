<?php

namespace frontend\helpers;
use yii\helpers\StringHelper;

class PriceHelper {
    public static function truncate($price){
        if(empty($price)){
            return '...';
        }
        return StringHelper::truncate($price, 4, '..');
    }
}
