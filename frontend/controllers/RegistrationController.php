<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use common\modules\user\models\User;
use \common\models\UserLanguage;
use common\models\Files;
use common\models\Language;
use yii\web\UploadedFile;
use common\models\UserDiploma;
use common\models\UserVerification;
use common\models\PaymentProfile;
use common\components\RegisterHelper;

class RegistrationController extends Controller {

    public function actions() {
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

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['customer', 'performer', 'performerfirst', 'performerlast', 'customerfirst', 'customerlast', 'fileupload'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionPerformer() {
        // set up new user/profile objects
        $user = Yii::$app->getModule("user")->model("User", ["scenario" => "register"]);
        $profile = Yii::$app->getModule("user")->model("Profile");
        $profile->scenario = 'register';
        $userLanguage = new UserLanguage();
        $languages = Language::getExistLanguagesArray(); // all exists languages - ao array for widget
        $files = new Files();
        $paymentProfile = new PaymentProfile();

        $post = Yii::$app->request->post();
        if ($user->load($post)) {
            $profile->load($post);
            // section ajax validate basic registration models
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($user, $profile);
            }
            // section normal validate basic registration models
            $transaction = Yii::$app->db->beginTransaction();
            if ($user->validate() && $profile->validate()) {
                $role = Yii::$app->getModule('user')->model('Role');
                $user->setRegisterAttributes($role::EXT_ROLE_PERFORMER, Yii::$app->request->userIP)->save(false);
                $profile->setUser($user->id)->save(false);
                $paymentProfile->paymentProfileLoader($post);
                $paymentProfile->user_id = $user->id;
                if ($paymentProfile->validate()) {
                    $this->afterRegister($user);
                    $successText = Yii::t("user", "Successfully registered [ {displayName} ]", ["displayName" => $user->getDisplayName()]);
                    $guestText = "";
                    if (Yii::$app->user->isGuest) {
                        $guestText = Yii::t("user", " - Please check your email to confirm your account");
                    }
                    Yii::$app->session->setFlash("Register-success", $successText . $guestText);
                    // section stars - now disabled
                    /* receive users languages and it`s ratings */
                    if (!empty($post) && isset($post['languages'])) {
                        $languages = array_filter($post['languages']);
                        /* user language implementation process */
                        UserLanguage::userLanguageImplements($languages, $user->id);
                    }
                    // section only photo uploads
                    if (!is_null(UploadedFile::getInstanceByName('photo'))) {
                        $photo_id = $files->saveSingleImage($user->id);
                        $profile->photo = $photo_id;
                    }
                    // section diploma and ID upload/attach
                    //Diploma
                    if (!is_null(UploadedFile::getInstancesByName('cert'))) {
                        $diplomaIdArray = $files->saveMultyImage($user->id, 'diploma', 'cert');
                        if (is_array($diplomaIdArray)) {
                            UserDiploma::DiplomaAttachmentProcess($user->id, $diplomaIdArray);
                        }
                    }
                    //ID
                    if (!is_null(UploadedFile::getInstancesByName('vercode'))) {
                        $verificationsIdArray = $files->saveMultyImage($user->id, 'verificationID', 'vercode');
                        if (is_array($verificationsIdArray)) {
                            UserVerification::VerifycationAttachmentProcess($user->id, $verificationsIdArray);
                        }
                    }
                    $Success = TRUE;
                    $paymentProfile->save(false);
                }// end paymentProfile validate
                else {
                    $Success = FALSE;
                    $transaction->rollBack();
                }
            }// end base validation
            else {
                $Success = FALSE;
                $transaction->rollBack();
            }
            if ($Success) {
                $transaction->commit();
            }
        }

        return $this->render('performer', [
                    'user' => $user,
                    'profile' => $profile,
                    'userLanguage' => $userLanguage,
                    'languages' => $languages,
                    'files' => $files,
                    'paymentProfile' => $paymentProfile,
        ]);
    }

    /* performer - переделка регистрации на две стадии */

    public function actionPerformerfirst() {
        $user = Yii::$app->getModule("user")->model("User", ["scenario" => "register"]);
        $profile = Yii::$app->getModule("user")->model("Profile");
        $profile->scenario = 'register';

        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            if ($user->load($post)) {
                $profile->load($post);

                if ($user->validate() && $profile->validate()) {
                    Yii::$app->session->setFlash('Register-success', 'passed the first stage of registration In order to proceed click on the link sent to you by e-mail');
                    RegisterHelper::performerRegistrationStep1($user, $profile);
                }
            }
        }

        return $this->renderAjax('performer_first', [
                    'user' => $user,
                    'profile' => $profile,
        ]);
    }

    public function actionCustomerfirst() {
        $user = Yii::$app->getModule("user")->model("User", ["scenario" => "register"]);
        $profile = Yii::$app->getModule("user")->model("Profile");
        $profile->scenario = 'register';

        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            if ($user->load($post)) {
                $profile->load($post);

                if ($user->validate() && $profile->validate()) {
                    Yii::$app->session->setFlash('Register-success', 'passed the first stage of registration In order to proceed click on the link sent to you by e-mail');
                    RegisterHelper::customerRegistrationStep1($user, $profile);
                }
            }
        }

        return $this->renderAjax('customer_first', [
                    'user' => $user,
                    'profile' => $profile,
        ]);
    }
    public function actionCustomerlast() {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            // подготавливаем модели
            if (!isset($post['signature']) || empty($post['signature'])) {
                throw new \yii\web\HttpException('500 user id undefined');
            } else {
                $user_id = (int) $post['signature'];
            }
            $user = User::find()->where('id = :id', [':id' => $user_id])->one();
            $profile = $user->profile;
            $userLanguage = new UserLanguage();
            $languages = Language::getExistLanguagesArray(); // all exists languages - ao array for widget
            $paymentProfile = new PaymentProfile();
            if (isset($post['start'])) { // идентификатор сабмита формы
                $check = RegisterHelper::customerRegistrationStep2($post, $user, $profile, $paymentProfile);
                if ($check) {
                    // завершающие регистрацию действия
                    $this->afterRegister($user);
                    $successText = Yii::t("user", "Successfully registered [ {displayName} ]", ["displayName" => $user->getDisplayName()]);
                    $guestText = "";
                    if (Yii::$app->user->isGuest) {
                        $guestText = Yii::t("user", " - Please check your email to confirm your account");
                    }
                    Yii::$app->session->setFlash("Register-success", $successText . $guestText);
                    // закрываем старую ссылку первой фазы
                    RegisterHelper::lockRegisterStage($user->id);
                }
            }

            return $this->renderAjax('customer_last', [
                        'user' => $user,
                        'profile' => $profile,
                        'userLanguage' => $userLanguage,
                        'languages' => $languages,
                        //'files' => $files,
                        'paymentProfile' => $paymentProfile,
            ]);
        }
    }
    public function actionPerformerlast() {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            // подготавливаем модели
            if (!isset($post['signature']) || empty($post['signature'])) {
                throw new \yii\web\HttpException('500 user id undefined');
            } else {
                $user_id = (int) $post['signature'];
            }
            $user = User::find()->where('id = :id', [':id' => $user_id])->one();
            $profile = $user->profile;
            $userLanguage = new UserLanguage();
            $languages = Language::getExistLanguagesArray(); // all exists languages - ao array for widget
            $paymentProfile = new PaymentProfile();
            if (isset($post['start'])) { // идентификатор сабмита формы
                $check = RegisterHelper::performerRegistrationStep2($post, $user, $profile, $paymentProfile);
                if ($check) {
                    // завершающие регистрацию действия
                    $this->afterRegister($user);
                    $successText = Yii::t("user", "Successfully registered [ {displayName} ]", ["displayName" => $user->getDisplayName()]);
                    $guestText = "";
                    if (Yii::$app->user->isGuest) {
                        $guestText = Yii::t("user", " - Please check your email to confirm your account");
                    }
                    Yii::$app->session->setFlash("Register-success", $successText . $guestText);
                    // закрываем старую ссылку первой фазы
                    RegisterHelper::lockRegisterStage($user->id);
                }
            }

            return $this->renderAjax('performer_last', [
                        'user' => $user,
                        'profile' => $profile,
                        'userLanguage' => $userLanguage,
                        'languages' => $languages,
                        //'files' => $files,
                        'paymentProfile' => $paymentProfile,
            ]);
        }
    }

    public function actionFileupload($id = NULL) {
        $user_id = (int) $id;
        $files = new Files();
        // section only photo uploads
        if (!is_null(UploadedFile::getInstanceByName('photo'))) {
            //$photo_id = $files->saveSingleImage($user_id);
            //$profile->photo = $photo_id;
            $files->saveSingleImage($user_id);         
        }
        //Diploma
        if (!is_null(UploadedFile::getInstancesByName('cert'))) {
            $diplomaIdArray = $files->saveMultyImage($user_id, 'diploma', 'cert');
            if (is_array($diplomaIdArray)) {
                UserDiploma::DiplomaAttachmentProcess($user_id, $diplomaIdArray);
            }
        }
        //ID
        if (!is_null(UploadedFile::getInstancesByName('vercode'))) {
            $verificationsIdArray = $files->saveMultyImage($user_id, 'verificationID', 'vercode');
            if (is_array($verificationsIdArray)) {
                UserVerification::VerifycationAttachmentProcess($user_id, $verificationsIdArray);
            }
        }
        return 0;
    }

    public function actionCustomer() {
        $user = Yii::$app->getModule("user")->model("User", ["scenario" => "register"]);
        $profile = Yii::$app->getModule("user")->model("Profile");
        $profile->scenario = 'register';
        $paymentProfile = new PaymentProfile();
        $post = Yii::$app->request->post();
        if ($user->load($post)) {
            $profile->load($post);
            // ajax validate registration
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($user, $profile);
            }
            $transaction = Yii::$app->db->beginTransaction();
            // section normal validate basic registration models
            if ($user->validate() && $profile->validate()) {

                $role = Yii::$app->getModule('user')->model('Role');
                $user->setRegisterAttributes($role::EXT_ROLE_CUSTOMER, Yii::$app->request->userIP)->save(false);
                $profile->setUser($user->id)->save(false);
                $paymentProfile->paymentProfileLoader($post);
                $paymentProfile->user_id = $user->id;
                if ($paymentProfile->validate()) {
                    $this->afterRegister($user);
                    $successText = Yii::t("user", "Successfully registered [ {displayName} ]", ["displayName" => $user->getDisplayName()]);
                    $guestText = "";
                    if (Yii::$app->user->isGuest) {
                        $guestText = Yii::t("user", " - Please check your email to confirm your account");
                    }
                    Yii::$app->session->setFlash("Register-success", $successText . $guestText);
                    $paymentProfile->save(false);
                    $Success = TRUE;
                }//end profile validate
                else {
                    $Success = FALSE;
                    $transaction->rollBack();
                }
            }// end basic validate
            else {
                $Success = FALSE;
                $transaction->rollBack();
            }

            if ($Success) {
                $transaction->commit();
            }
        }
        return $this->render('customer', [
                    'user' => $user,
                    'profile' => $profile,
                    'paymentProfile' => $paymentProfile
        ]);
    }

    protected function afterRegister($user) {
        /** @var \common\modules\user\models\UserKey $userKey */
        // determine userKey type to see if we need to send email
        $userKey = Yii::$app->getModule("user")->model("UserKey");
        if ($user->status == $user::STATUS_INACTIVE) {
            $userKeyType = $userKey::TYPE_EMAIL_ACTIVATE;
        } elseif ($user->status == $user::STATUS_UNCONFIRMED_EMAIL) {
            $userKeyType = $userKey::TYPE_EMAIL_CHANGE;
        } else {
            $userKeyType = null;
        }

        // check if we have a userKey type to process, or just log user in directly
        if ($userKeyType) {

            // generate userKey and send email
            $userKey = $userKey::generate($user->id, $userKeyType);
            if (!$numSent = $user->sendEmailConfirmation($userKey)) {

                // handle email error
                //Yii::$app->session->setFlash("Email-error", "Failed to send email");
            }
        } else {
            Yii::$app->user->login($user, Yii::$app->getModule("user")->loginDuration);
        }
    }

}
