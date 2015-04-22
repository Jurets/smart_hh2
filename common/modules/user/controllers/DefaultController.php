<?php

namespace common\modules\user\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;
use common\models\Files;
use common\models\UserDiploma;
use common\models\UserVerification;
use common\models\Category;
use common\models\UserSpeciality;
use common\models\Ticket;
use common\models\PaymentHistory;
use yii\web\NotFoundHttpException;
use common\models\PaymentProfile;
use common\models\Withdrawal;
use yii\web\UploadedFile;
use common\models\Language;
use common\models\UserLanguage;
use frontend\helpers\ContactsHelper;
use yii\helpers\Json;

/* just test - before logic */
use common\modules\user\models\Profile;
use common\models\Review;
use common\components\UserActivity;

/**
 * Default controller for User module
 */
class DefaultController extends Controller {

    /**
     * @inheritdoc
     */
    private $profile; // self user profile here
    private $specialities;

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        parent::beforeAction($action);
        $this->profile = isset(Yii::$app->user->identity->profile) ? Yii::$app->user->identity->profile : NULL;
        $speciality = new UserSpeciality;
        $this->specialities = $speciality->getUserSpeciality();
        // User Activity Control
        UserActivity::updateOnlineDate(Yii::$app->user->id);
        return TRUE;
    }

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'confirm', 'resend'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                    [
                        'actions' => ['account', 'profile', 'cabinet', 'popup_render', 'cat_dell', 'diploma_dell', 'verid_dell', 'popup_runtime', 'resend-change', 'cancel', 'logout', 'test', 'offer-job', 'get-offer-job-popup', 'withdrawals', 'option-languages', 'update-languages'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login', 'register', 'forgot', 'reset', 'option-languages', 'update-languages'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionTest() {
//        $userList = Profile::find()->all();
//        $users = [];
//        if (is_array($userList) && !empty($userList)) {
//            foreach ($userList as $user) {
//                $users[$user->user_id] = $user->user->username;
//            }
//        }
//        $post = Yii::$app->request->post();
//        if ($post) {
//            // review mech
//        }
//        return $this->renderPartial('_test', [
//                    'users' => $users,
//        ]);
    }

    /**
     * Display index - debug page, login page, or account page
     */
    public function actionIndex($cid = NULL) {
        $category = new Category;
        $categories = $category->categoryOutput($cid);
        $model = Yii::$app->getModule('user')->model('user');
        $query = $model->userSearchService();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        return $this->render('index', [
                    'categories' => $categories,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /*
     * serve User Cabinet
     */

    /* AJAX delete categories */

    public function actionCat_dell() {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            if (isset($post['id'])) {
                $id = (int) $post['id'];
                $userSpeciality = UserSpeciality::findOne(['user_id' => Yii::$app->user->id, 'category_id' => $id]);
                $userSpeciality->delete();
                $this->specialities = $userSpeciality->getUserSpeciality();
            }
            echo $this->renderPartial('_cabinet-category-item', ['userSpecialities' => $this->specialities]);
        }
    }

    /* Ajax delete Diploma */

    public function actionDiploma_dell() {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            if (isset($post['id'])) {
                $id = (int) $post['id'];
                $diploma = Files::findOne(['user_id' => Yii::$app->user->id, 'id' => $id]);
                $userDiploma = UserDiploma::findOne(['file_id' => $id]);
                if (!is_null($diploma) && !is_null($userDiploma)) {
                    $userDiploma->delete();
                    $diploma->delete();
                }
                $renderUserDiploma = Files::findAll(['user_id' => Yii::$app->user->id, 'description' => 'diploma']);
                echo $this->renderPartial('_table-diploma', ['userDiploma' => $renderUserDiploma]);
            }
        }
    }

    /* Ajax delete Verifycations Documents */

    public function actionVerid_dell() {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            $id = (int) $post['id'];
            if (isset($post['id'])) {
                $verifyDocument = Files::findOne(['user_id' => Yii::$app->user->id, 'id' => $id]);
                $userVerifyDocument = UserVerification::findOne(['file_id' => $id]);
                if (!is_null($verifyDocument) && !is_null($userVerifyDocument)) {
                    $userVerifyDocument->delete();
                    $verifyDocument->delete();
                }
                $renderVuerifyId = Files::FindAll(['user_id' => Yii::$app->user->id, 'description' => 'verificationID']);
                echo $this->renderPartial('_verificationid-table', ['userVerid' => $renderVuerifyId]);
            }
        }
    }

    public function actionCabinet() {

        /* set id_usr_from_profile for header_login layout */
        $session = Yii::$app->session;
        $session['id_usr_from_profile'] = Yii::$app->user->id;

        $userDiploma = Files::findAll(['user_id' => Yii::$app->user->id, 'description' => 'diploma']);
        $userVerid = Files::findAll(['user_id' => Yii::$app->user->id, 'description' => 'verificationID']);

        $userSocialNetworks = $this->profile->user->getAllSocialNetworks();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            // Change Photo without ajax
            if (isset($post['signature']) && $post['signature'] === 'PhotoUploads') {
                $file = new Files();
                if (!is_null(UploadedFile::getInstanceByName('photo'))) {
                    if ($file->validate()) {
                        $files_id = $file->saveSingleImage(Yii::$app->user->id, 'photo', 'photo');
                        $this->profile->photo = $files_id;
                        $this->profile->save(false);
                    }
                }
            }
            // Change Diploma without ajax
            if (isset($post['signature']) && $post['signature'] === 'Diploma') {
                $this->cabinetDiploma($post);
                $userDiploma = Files::findAll(['user_id' => Yii::$app->user->id, 'description' => 'diploma']);
            }
            // Change Verifycation ID Documents without ajax
            if (isset($post['signature']) && $post['signature'] === 'Verid') {
                $this->cabinetVerid($post);
                $userVerid = Files::findAll(['user_id' => Yii::$app->user->id, 'description' => 'verificationID']);
            }
            if (isset($post['signature']) && $post['signature'] === 'Spesialites') {
                $category = new Category;
                $categories = $category->categoryOutput(NULL);
            }
            if (isset($post['UserSocialNetwork'])) {
                $userSocialNetwork = $userSocialNetworks[$post['UserSocialNetwork']['social_network_id']];
                $userSocialNetwork->url = $post['UserSocialNetwork']['url'];
                $userSocialNetwork->moderate = 0;
                $userSocialNetwork->save();
            }
        }
        /* PAYMENT HISTORY */
        $get = Yii::$app->request->get();
        if (!isset($get['ph-kind'])) {
            // default selection
            $paymentQuery = PaymentHistory::find();
            $paymentQuery->Where(['from_user_id' => Yii::$app->user->id]);
            $switchWindow = 0;
        } else {
            // post drive selection cascade
            if ((int) $get['ph-kind'] === 0) {
                // from user money out + single request summ amount
                $paymentQuery = PaymentHistory::find();
                $paymentQuery->Where(['from_user_id' => Yii::$app->user->id]);
                $switchWindow = 0;
            }
            if ((int) $get['ph-kind'] === 1) {
                // to user money + single request summ amount
                $paymentQuery = PaymentHistory::find(['to_user_id' => Yii::$app->user->id]);
                $paymentQuery->Where(['to_user_id' => Yii::$app->user->id]);
                $switchWindow = 1;
            }

            // date filters
            if (!empty($get['ph-year'])) {
                $year = (int) $get['ph-year'];
                // andWhere year(date) = (int)...
                $paymentQuery->andWhere('year(date)=:year', [':year' => $year]);
            }
            if (!empty($get['ph-month'])) {
                $month = (int) $get['ph-month'];
                // andWhere month(date) = (int)...
                $paymentQuery->andWhere('month(date)=:month', [':month' => $month]);
            }
        }
        $paymentHistoryDataProvider = new ActiveDataProvider([
            'query' => $paymentQuery,
            'pagination' => [
                'pageSize' => 5
            ]
        ]);
        $amountQuery = PaymentHistory::find();
        if ($switchWindow === 0) {
            $amountQuery->where(['from_user_id' => Yii::$app->user->id]);
        } else {
            $amountQuery->where(['to_user_id' => Yii::$app->user->id]);
        }
        $amountAll = $amountQuery->sum('amount');
        /* PAYMENT HISTORY  END */
        /* payee kind setup check */
        $paymentProfile = PaymentProfile::findOne(['user_id'=>Yii::$app->user->id]);
        if(is_null($paymentProfile)){
            $paymentProfileChoiseMessage = Yii::t('app', 'Payee Details').' '.Yii::t('app', 'not set');
        }else{
            $paymentProfileChoiseMessage = $paymentProfile->choiseKind[$paymentProfile->choise];
        }

        $languages = ContactsHelper::getLanguages($this->profile->user->id); //array - languages of current user
        $langList = Language::getExistLanguagesArray(); // array - all exists languages for widget

        return $this->render('cabinet', [
                    'profile' => $this->profile,
                    'userSpecialities' => $this->specialities,
                    'userDiploma' => $userDiploma,
                    'userVerid' => $userVerid,
                    'userSocialNetworks' => $userSocialNetworks,
                    'paymentHistoryDataProvider' => $paymentHistoryDataProvider,
                    'switchWindow' => $switchWindow,
                    'amountAll' => $amountAll,
                    'paymentProfileChoiseMessage' => $paymentProfileChoiseMessage,
                    'langList' => $langList,
                    'languages' => $languages
        ]);
    }

    public function actionPopup_render() {
        $signature = NULL;
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            $signature = $post['signature'];
        }
        return $this->renderAjax('popup', [
                    'signature' => $signature,
        ]);
    }

    public function actionPopup_runtime() {

        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            $this->cabinetServiceChoise($post);
        }
    }

    /* cabinet choise */

    private function cabinetServiceChoise($post) {
        switch ($post['signature']) {
            case 'HourlyRate' :
            case 'PhotoUploads':
                $this->cabinetUserItem($post);
                break;
            case 'english' :
            case 'russian' :
            case 'AdressMailing':
            case 'Phone':
            case 'BillingAddress':
            case 'PayeeProfile':
                $this->cabinetUserContact($post);
                break;
            case 'Specialites':
                $this->cabinetSpecialites($post);
                break;
        }
    }

    // cabinet addons (5 parts)
    private function cabinetUserItem($post) {
        if (isset($post['hourly_rate'])) {
            $this->profile->hourly_rate = $post['hourly_rate'];
            if ($this->profile->validate()) {
                $this->profile->save(false);
            } else {
                throw new NotFoundHttpException($this->renderErrors($this->profile->errors), '0');
            }
        }
        echo $this->renderAjax('_cabinet-user-item', [
            'profile' => $this->profile,
        ]);
    }

    private function cabinetUserContact($post) {
        if (isset($post['english'])) {
            $language = \common\models\UserLanguage::find()
                            ->where([
                                'user_id' => $this->profile->user_id,
                                'language_id' => 1,
                            ])->one();
            if (is_null($language)) {
                $language = new \common\models\UserLanguage;
            }
            $language->user_id = $this->profile->user_id;
            $language->language_id = 1;
            $language->knowledge = $post['english'];
            if ($language->validate()) {
                $language->save(false);
            } else {
                throw new NotFoundHttpException($this->renderErrors($language->errors), '0');
            }
        }
        if (isset($post['russian'])) {
            $language = \common\models\UserLanguage::find()
                            ->where([
                                'user_id' => $this->profile->user_id,
                                'language_id' => 2,
                            ])->one();
            if (is_null($language)) {
                $language = new \common\models\UserLanguage;
            }
            $language->user_id = $this->profile->user_id;
            $language->language_id = 2;
            $language->knowledge = $post['russian'];
            if ($language->validate()) {
                $language->save(false);
            } else {
                throw new NotFoundHttpException($this->renderErrors($language->errors), '0');
            }
        }
        if (isset($post['adress_mailing'])) {
            $this->profile->adress_mailing = \yii\helpers\Html::encode($post['adress_mailing']);
            if ($this->profile->validate()) {
                $this->profile->save(false);
            } else {
                throw new NotFoundHttpException($this->renderErrors($this->profile->errors), '0');
            }
        }
        if (isset($post['phone'])) {
            $this->profile->phone = \yii\helpers\Html::encode($post['phone']);
            if ($this->profile->validate()) {
                $this->profile->save(false);
            } else {
                throw new NotFoundHttpException($this->renderErrors($this->profile->errors), '0');
            }
        }
        if (isset($post['adress_billing'])) {
            $this->profile->adress_billing = \yii\helpers\Html::encode($post['adress_billing']);
            if ($this->profile->validate()) {
                $this->profile->save(false);
            } else {
                throw new NotFoundHttpException($this->renderErrors($this->profile->errors), '0');
            }
        }
        /* user payment profile setup */
        if (isset($post['signature']) && $post['signature'] === 'PayeeProfile') {
            // TO DO Действия над платежным профилем пользователя
            if (!empty($post['ppid'])) {
                $ppid = (int) $post['ppid'];
                $paymentProfile = \common\models\PaymentProfile::findOne(['id' => $ppid]);
            } else {
                $paymentProfile = new \common\models\PaymentProfile;
            }
            $paymentProfile->paymentProfileLoader($post);
            $paymentProfile->user_id = Yii::$app->user->id;
            if ($paymentProfile->validate()) {
                $paymentProfile->save(false);
            } else {
                throw new NotFoundHttpException($this->renderErrors($paymentProfile->errors), '0');
            }
        } else {
            $paymentProfile = \common\models\PaymentProfile::findOne(['user_id'=>Yii::$app->user->id]);
            if(is_null($paymentProfile)){
                $paymentProfile = new \common\models\PaymentProfile;
            }
        }

        echo $this->renderPartial('_user-contacts', [
            'profile' => $this->profile,
            'paymentProfile' => $paymentProfile,
            'paymentProfileChoiseMessage' => $paymentProfile->getChoiseMessage()
        ]);
    }

    private function cabinetSpecialites($post) {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            $userSpeciality = new UserSpeciality;
            $userSpeciality->user_id = Yii::$app->user->id;
            if (!isset($post['category_id']) || (int) $post['category_id'] === 0) {
                echo $this->renderPartial('_cabinet-category-item', ['userSpecialities' => $this->specialities]);
                return TRUE;
            }
            $userSpeciality->category_id = (int) $post['category_id'];
            if ($userSpeciality->validate()) {
                $userSpeciality->save(false);
                $this->specialities = $userSpeciality->getUserSpeciality();
            } else {
                throw new NotFoundHttpException($this->renderErrors($userSpeciality->errors), '0');
            }
        }
        echo $this->renderPartial('_cabinet-category-item', ['userSpecialities' => $this->specialities]);
    }

    private function cabinetDiploma($post) {
        if (!is_null(UploadedFile::getInstancesByName('cert'))) {
            $file = new Files;
            $diplomaIds = $file->saveMultyImage(Yii::$app->user->id, 'diploma', 'cert');
            if (is_array($diplomaIds)) {
                UserDiploma::DiplomaAttachmentProcess(Yii::$app->user->id, $diplomaIds);
            }
        }
    }

    private function cabinetVerid($post) {
        if (!is_null(UploadedFile::getInstancesByName('vercode'))) {
            $file = new Files;
            $verIds = $file->saveMultyImage(Yii::$app->user->id, 'verificationID', 'vercode');
            if (is_array($verIds)) {
                UserVerification::VerifycationAttachmentProcess(Yii::$app->user->id, $verIds);
            }
        }
    }

    protected function renderErrors($errors) {
        $message = '';
        foreach ($errors as $error) {
            $message .= '<p style="color:red;">' . $error[0] . '</p>';
        }
        return $message;
    }

    /**
     * Display login page
     */
    public function actionLogin() {
        /** @var \common\modules\user\models\forms\LoginForm $model */
        // load post data and login
        $model = Yii::$app->getModule("user")->model("LoginForm");
        if ($model->load(Yii::$app->request->post()) && $model->login(Yii::$app->getModule("user")->loginDuration)) {
            //Process Login Registration
            UserActivity::changeNetworkStatus(Yii::$app->user->id, 'on');
            return $this->goBack(Yii::$app->getModule("user")->loginRedirect);
        }

        // render
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Log user out and redirect
     */
    public function actionLogout() {
        //Process Logout Registration
        UserActivity::changeNetworkStatus(Yii::$app->user->id, 'off');
        Yii::$app->user->logout();

        // redirect
        $logoutRedirect = Yii::$app->getModule("user")->logoutRedirect;
        if ($logoutRedirect === null) {
            return $this->goHome();
        } else {
            return $this->redirect($logoutRedirect);
        }
    }

    /**
     * Display registration page
     */
    public function actionRegister() {
        /** @var \common\modules\user\models\User    $user */
        /** @var \common\modules\user\models\Profile $profile */
        /** @var \common\modules\user\models\Role    $role */
        // set up new user/profile objects
        $user = Yii::$app->getModule("user")->model("User", ["scenario" => "registeruser"]);
        $profile = Yii::$app->getModule("user")->model("Profile");

        // load post data
        $post = Yii::$app->request->post();
        if ($user->load($post)) {

            // ensure profile data gets loaded
            $profile->load($post);

            // validate for ajax request
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($user, $profile);
            }

            // validate for normal request
            if ($user->validate() && $profile->validate()) {

                // perform registration
                $role = Yii::$app->getModule("user")->model("Role");
                $user->setRegisterAttributes($role::ROLE_USER, Yii::$app->request->userIP)->save(false);
                $profile->setUser($user->id)->save(false);
                $this->afterRegister($user);

                // set flash
                // don't use $this->refresh() because user may automatically be logged in and get 403 forbidden
                $successText = Yii::t("user", "Successfully registered [ {displayName} ]", ["displayName" => $user->getDisplayName()]);
                $guestText = "";
                if (Yii::$app->user->isGuest) {
                    $guestText = Yii::t("user", " - Please check your email to confirm your account");
                }
                Yii::$app->session->setFlash("Register-success", $successText . $guestText);
            }
        }

        // render
        return $this->render("register", [
                    'user' => $user,
                    'profile' => $profile,
        ]);
    }

    /**
     * Process data after registration
     *
     * @param \common\modules\user\models\User $user
     */
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

    /**
     * Confirm email
     */
    public function actionConfirm($key) {
        /** @var \common\modules\user\models\UserKey $userKey */
        /** @var \common\modules\user\models\User $user */
        // search for userKey
        $success = false;
        $userKey = Yii::$app->getModule("user")->model("UserKey");
        $userKey = $userKey::findActiveByKey($key, [$userKey::TYPE_EMAIL_ACTIVATE, $userKey::TYPE_EMAIL_CHANGE]);
        if ($userKey) {

            // confirm user
            $user = Yii::$app->getModule("user")->model("User");
            $user = $user::findOne($userKey->user_id);
            $user->confirm();

            // consume userKey and set success
            $userKey->consume();
            $success = $user->email;
        }

        // render
        return $this->render("confirm", [
                    "userKey" => $userKey,
                    "success" => $success
        ]);
    }

    /**
     * Account
     */
    public function actionAccount() {
        /** @var \common\modules\user\models\User $user */
        /** @var \common\modules\user\models\UserKey $userKey */
        // set up user and load post data
        $user = Yii::$app->user->identity;
        $user->setScenario("account");
        $loadedPost = $user->load(Yii::$app->request->post());

        // validate for ajax request
        if ($loadedPost && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($user);
        }

        // validate for normal request
        if ($loadedPost && $user->validate()) {

            // generate userKey and send email if user changed his email
            if (Yii::$app->getModule("user")->emailChangeConfirmation && $user->checkAndPrepEmailChange()) {

                $userKey = Yii::$app->getModule("user")->model("UserKey");
                $userKey = $userKey::generate($user->id, $userKey::TYPE_EMAIL_CHANGE);
                if (!$numSent = $user->sendEmailConfirmation($userKey)) {

                    // handle email error
                    //Yii::$app->session->setFlash("Email-error", "Failed to send email");
                }
            }

            // save, set flash, and refresh page
            $user->save(false);
            Yii::$app->session->setFlash("Account-success", Yii::t("user", "Account updated"));
            return $this->refresh();
        }

        // render
        return $this->render("account", [
                    'user' => $user,
        ]);
    }

    /**
     * Profile
     */
    public function actionProfile($id = NULL) {
        /** @var \common\modules\user\models\Profile $profile */
        $id = (int) $id;

        /* session id_usr_from_profile */
        $session = Yii::$app->session;
        $session['id_usr_from_profile'] = $id;

        if ($id === 0) {
            $profile = Yii::$app->user->identity->profile;
            $id = Yii::$app->user->id;
        } else {
            $profile = \common\modules\user\models\Profile::findOne(['user_id' => $id]);
        }
        $activityMessage = UserActivity::NetworkStatus($id);
        $doneTaskMessage = UserActivity::lastDoneTask($id);
        $file = new Files;
        $userFilesPrepare = $file->getUserFiles($id);
        $spec = new UserSpeciality;
        $userSpecialities = $spec->getSpecialityByUserId($id);


        $photos = $userFilesPrepare['photo'];
        $diplomas = $userFilesPrepare['diploma'];
        $verificationIDs = $userFilesPrepare['verificationID'];

        $jobsCreatedQuery = Ticket::find()
                ->andWhere(['user_id' => $id])
                ->andWhere(['not', ['status' => Ticket::STATUS_COMPLETED]]);
        $jobsCreatedDataProvider = new ActiveDataProvider([
            'query' => $jobsCreatedQuery,
            'pagination' => [
                'pageSize' => Yii::$app->params['profile.jobs.pageSize'],
            ],
        ]);

        $jobsAppliedQuery = Ticket::find()
                ->andWhere(['performer_id' => $id])
                ->andWhere(['not', ['status' => Ticket::STATUS_COMPLETED]]);
        $jobsAppliedDataProvider = new ActiveDataProvider([
            'query' => $jobsAppliedQuery,
            'pagination' => [
                'pageSize' => Yii::$app->params['profile.jobs.pageSize'],
            ],
        ]);
        
        $jobsDonedQuery = Ticket::find()
                ->andWhere(['performer_id' => $id])
                ->andWhere(['status' => Ticket::STATUS_COMPLETED]);
        $jobsDonedDataProvider = new ActiveDataProvider([
            'query' => $jobsDonedQuery,
            'pagination' => [
                'pageSize' => Yii::$app->params['profile.jobs.pageSize'],
            ],
        ]);

        $positiveReviewsQuery = Review::find()
                ->where([
                    'to_user_id' => $id,
                ])
                ->andWhere('rating>=:minRating', [
            'minRating' => Yii::$app->params['profile.reviews.minPositiveRating']
        ]);
        $positiveReviewDataProvider = new ActiveDataProvider([
            'query' => $positiveReviewsQuery,
            'pagination' => [
                'pageSize' => Yii::$app->params['profile.reviews.pageSize'],
            ],
        ]);
        $negativeReviewsQuery = Review::find()
                ->where([
                    'to_user_id' => $id,
                ])
                ->andWhere('rating<:minRating', [
            'minRating' => Yii::$app->params['profile.reviews.minPositiveRating']
        ]);
        $negativeReviewDataProvider = new ActiveDataProvider([
            'query' => $negativeReviewsQuery,
            'pagination' => [
                'pageSize' => Yii::$app->params['profile.reviews.pageSize'],
            ],
        ]);

        $this->on(Controller::EVENT_AFTER_ACTION, [Yii::$app->notification, 'handleNotificationRead'], [
            'userId' => Yii::$app->user->id,
            'entity' => 'review',
            'entityId' => null,
        ]);

        $canViewContacts = ($id === Yii::$app->user->id) || (Ticket::find()
                        ->where([
                            'user_id' => Yii::$app->user->id,
                            'performer_id' => $id,
                        ])
                        ->andWhere(['not', ['status' => Ticket::STATUS_COMPLETED]])
                        ->exists());

        /* Withdrawals prepare */
        $paymentProfile = PaymentProfile::findOne(['user_id' => Yii::$app->user->id]);
        $ppErr = NULL;
//        if(is_null($paymentProfile)){
//            $ppErr = Yii::t('app','You has not any payee data. Setup it in  users cabinet');
//        }    
        // render
        /* variables in view translate as arrays */

        $languages = ContactsHelper::getLanguages($profile->user->id);

        return $this->render("profile", [
                    'profile' => $profile,
                    'photos' => $photos,
                    'diplomas' => $diplomas,
                    'verificationIDs' => $verificationIDs,
                    'userSpecialities' => $userSpecialities,
                    'activityMessage' => $activityMessage,
                    'doneTaskMessage' => $doneTaskMessage,
                    'jobsCreatedDataProvider' => $jobsCreatedDataProvider,
                    'jobsAppliedDataProvider' => $jobsAppliedDataProvider,
                    'jobsDonedDataProvider' => $jobsDonedDataProvider,
                    'positiveReviewDataProvider' => $positiveReviewDataProvider,
                    'negativeReviewDataProvider' => $negativeReviewDataProvider,
                    'canViewContacts' => $canViewContacts,
                    'paymentProfile' => $paymentProfile,
                    'languages' => $languages
        ]);
    }

    /*
     * Send withdraw message 
     */

    public function actionWithdrawals() {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();

            $user_id = (int) $post['user_id'];
            $choise = (int) $post['choise'];
            $amount = empty($post['amount']) ? 0 : (double) $post['amount'];
            if ($amount == 0) {
                throw new NotFoundHttpException(Yii::t('app', 'ammount not signed'));
            } else {
                $user = \common\modules\user\models\User::findOne(['id' => $user_id]);
                
                $balance = (float) $user->balance;
                if ($amount > $balance) {
                    throw new NotFoundHttpException(Yii::t('app', 'Amount to large'));
                } else {
                    $rest = $balance - $amount;
                    $withdrawal = new Withdrawal;
                    $compile = PaymentProfile::withdrawalCompile($user_id, $choise, $amount);
                    $withdrawal->modelConnection($compile);
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                        $user->balance = $rest;
                        $user->save();
                        $withdrawal->save();
                        $transaction->commit();
                    } catch (Exception $e) {
                        // mail to admin ?
                        $transaction->rollBack();
                    }
                }
            }
        }
        echo 'within 24 hours you will be transferred money';
    }

    /**
     * Resend email confirmation
     */
    public function actionResend() {
        /** @var \common\modules\user\models\forms\ResendForm $model */
        // load post data and send email
        $model = Yii::$app->getModule("user")->model("ResendForm");
        if ($model->load(Yii::$app->request->post()) && $model->sendEmail()) {

            // set flash (which will show on the current page)
            Yii::$app->session->setFlash("Resend-success", Yii::t("user", "Confirmation email resent"));
        }

        // render
        return $this->render("resend", [
                    "model" => $model,
        ]);
    }

    /**
     * Resend email change confirmation
     */
    public function actionResendChange() {
        /** @var \common\modules\user\models\User    $user */
        /** @var \common\modules\user\models\UserKey $userKey */
        // find userKey of type email change
        $user = Yii::$app->user->identity;
        $userKey = Yii::$app->getModule("user")->model("UserKey");
        $userKey = $userKey::findActiveByUser($user->id, $userKey::TYPE_EMAIL_CHANGE);
        if ($userKey) {

            // send email and set flash message
            $user->sendEmailConfirmation($userKey);
            Yii::$app->session->setFlash("Resend-success", Yii::t("user", "Confirmation email resent"));
        }

        // redirect to account page
        return $this->redirect(["/user/account"]);
    }

    /**
     * Cancel email change
     */
    public function actionCancel() {
        /** @var \common\modules\user\models\User    $user */
        /** @var \common\modules\user\models\UserKey $userKey */
        // find userKey of type email change
        $user = Yii::$app->user->identity;
        $userKey = Yii::$app->getModule("user")->model("UserKey");
        $userKey = $userKey::findActiveByUser($user->id, $userKey::TYPE_EMAIL_CHANGE);
        if ($userKey) {

            // remove `user.new_email`
            $user->new_email = null;
            $user->save(false);

            // expire userKey and set flash message
            $userKey->expire();
            Yii::$app->session->setFlash("Cancel-success", Yii::t("user", "Email change cancelled"));
        }

        // go to account page
        return $this->redirect(["/user/account"]);
    }

    /**
     * Forgot password
     */
    public function actionForgot() {
        /** @var \common\modules\user\models\forms\ForgotForm $model */
        // load post data and send email
        $model = Yii::$app->getModule("user")->model("ForgotForm");
        if ($model->load(Yii::$app->request->post()) && $model->sendForgotEmail()) {

            // set flash (which will show on the current page)
            Yii::$app->session->setFlash("Forgot-success", Yii::t("user", "Instructions to reset your password have been sent"));
        }

        // render
        return $this->render("forgot", [
                    "model" => $model,
        ]);
    }

    /**
     * Reset password
     */
    public function actionReset($key) {
        /** @var \common\modules\user\models\User    $user */
        /** @var \common\modules\user\models\UserKey $userKey */
        // check for valid userKey
        $userKey = Yii::$app->getModule("user")->model("UserKey");
        $userKey = $userKey::findActiveByKey($key, $userKey::TYPE_PASSWORD_RESET);
        if (!$userKey) {
            return $this->render('reset', ["invalidKey" => true]);
        }

        // get user and set "reset" scenario
        $success = false;
        $user = Yii::$app->getModule("user")->model("User");
        $user = $user::findOne($userKey->user_id);
        $user->setScenario("reset");

        // load post data and reset user password
        if ($user->load(Yii::$app->request->post()) && $user->save()) {

            // consume userKey and set success = true
            $userKey->consume();
            $success = true;
        }

        // render
        return $this->render('reset', compact("user", "success"));
    }

    public function actionOfferJob() {
        $post = Yii::$app->request->post();
        if (isset($post['tickets']) && isset($post['user_id'])) {
            foreach ($post['tickets'] as $ticketId) {
                $ticket = Ticket::findOne($ticketId);
                if ($ticket === null) {
                    continue;
                }
                $offer = new \common\models\Offer();
                $offer->ticket_id = $ticketId;
                $offer->performer_id = $post['user_id'];
                $offer->stage = \common\models\Offer::STAGE_OWNER_OFFER;
                if ($offer->save()) {
                    $offerHistory = new \common\models\OfferHistory();
                    $offerHistory->offer_id = $offer->id;
                    $offerHistory->price = is_null($ticket->price) ? 0 : $ticket->price;
                    $offerHistory->note = Yii::t('app', 'check out this job');
                    $offerHistory->save();
                }
            }
        }
        $this->redirect(['/user']);
    }

    public function actionGetOfferJobPopup() {
        $post = Yii::$app->request->post();
        $performerId = isset($post['user_id']) ? $post['user_id'] : null;
        if (is_null($performerId)) {
            $tickets = [];
        } else {
            $tickets = Ticket::find()
                    ->where([
                        'and',
                        ['ticket.status' => [Ticket::STATUS_NOT_COMPLETED],
                            'ticket.user_id' => Yii::$app->user->id],
                        ['not exists', (new \yii\db\Query)->select('offer.id')->from('offer')->where([
                                'and',
                                'offer.ticket_id=ticket.id',
                                ['offer.performer_id' => $performerId]
                            ])]
                    ])
                    ->all();
        }
        return $this->renderPartial('popup/_offer-job', [
                    'tickets' => $tickets,
                    'userId' => $performerId
        ]);
    }

    public function actionOptionLanguages() {
        $output = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $parents = array_filter($parents, function ($value){ return is_numeric($value); });
                $output = Language::getOptionLanguagesArray($parents); 
                echo Json::encode(['output' => $output, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionUpdateLanguages() {
        $output = '';
        if(Yii::$app->request->isAjax){
            $post = Yii::$app->request->post();
            if (!empty($post) && isset($post['languages']) && isset($post['userId'])) {
                $languages = array_filter($post['languages']);
                $userId = (int)$post['userId'];
                if(UserLanguage::userLanguageImplements($languages, $userId)){
                    $languages = ContactsHelper::getLanguages($this->profile->user->id); //array - languages of current user
                    $langList = Language::getExistLanguagesArray(); // array - all exists languages for widget
                    $output = $this->render('_languages_list', ['langList' => $langList, 'languages' => $languages]);
                }
            }
        }
        return $output;
    }
}
