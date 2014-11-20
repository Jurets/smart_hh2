<?php
namespace common\controllers;

use Yii;
use yii\web\Controller as native_Controller;

class Controller extends native_Controller {
	
	/* use undepended user ban simple verifycation */
    public function init() {
		parent::init();
        \common\modules\user\models\User::BanSrvVerification();return TRUE;
    }
	
}

