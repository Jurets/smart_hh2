<?php

namespace common\components;

use Yii;

class TwitterHelper {

    public static function sendPost($message) {
        $twitter = Yii::$app->twitter->getTwitterTokened(Yii::$app->params['twitter_access_token'], Yii::$app->params['twitter_access_token_secret']);
        $result = $twitter->post('statuses/update', ['status' => $message]);

        return $result;
    }
}