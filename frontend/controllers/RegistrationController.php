<?php

namespace frontend\controllers;

use common\models\Files;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use \common\models\UserLanguage;

class RegistrationController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionPerformer()
    {
        // set up new user/profile objects
        $user    = Yii::$app->getModule("user")->model("User", ["scenario" => "register"]);
        $profile = Yii::$app->getModule("user")->model("Profile");
        $userLanguage = new UserLanguage();
        $files = new Files();

        return $this->render('performer', ['user'=>$user, 'profile'=>$profile, 'userLanguage'=>$userLanguage, 'files'=>$files]);
    }

} 