<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use common\models\TicketComments;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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

    /**
     * @inheritdoc
     */
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

    /* for customize eroor page (404, 500, e.t.c) */
    public function actionCustomError(){
        $error = Yii::$app->errorHandler;
        return $this->renderPartial('custom-error', ['error'=>$error]);
    }
    // static page actions
    /* все страницы делаются по аналогии - меняется лишь контент-часть */
    public function actionAboutus($language = 'en') {
        try {
            return $this->render('static/' . $language . '/aboutus');
        } catch (InvalidParamException $ex) {
            throw new \yii\web\HttpException('404 page not found');
        }
    }
    public function actionFaq($language = 'en') {
        try {
            return $this->render('static/' . $language . '/faq');
        } catch (InvalidParamException $ex) {
            throw new \yii\web\HttpException('404 page not found');
        }
    }
    public function actionTermsandagreements($language = 'en') {
        try {
            return $this->render('static/' . $language . '/termsandagreement');
        } catch (InvalidParamException $ex) {
            throw new \yii\web\HttpException('404 page not found');
        }
    }
    public function actionContactus($language = 'en') {
        try {
            return $this->render('static/' . $language . '/contactus');
        } catch (InvalidParamException $ex) {
            throw new \yii\web\HttpException('404 page not found');
        }
    }
    // end of static page section

    public function actionLanguageswitcher() {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            $language = \yii\helpers\Html::encode($post['language']);
            \common\components\Commonhelper::setLanguage($language);
        }
    }

    public function actionIndex($registrate = NULL, $code = NULL) {
        if (!is_null($registrate) && !is_null($code)) {
            $this->view->params['regmode'] = \yii\helpers\Html::encode($registrate);
            $hash = \yii\helpers\Html::encode($code);
            /* если запущена ссылка с первого этапа регистрации - рендерится окно второго этапа регистрации */
            $this->view->params['reguser'] = \common\components\RegisterHelper::checkFirstReference($hash);
        }
        $latestTasks = \common\models\Ticket::find()
                ->where([
                    'is_turned_on' => 1,
                    'status' => \common\models\Ticket::STATUS_NOT_COMPLETED,
                ])
                ->orderBy(['created' => SORT_DESC])
                ->limit(8)
                ->all();
        $sliders = \common\models\Slider::find()->all();
        return $this->renderPartial('index', ['latestTasks' => $latestTasks, 'sliders' => $sliders]);
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    public function actionClearNewComments() {
        TicketComments::updateAll([
            'status' => TicketComments::STATUS_READ
                ], [
            'ticket_id' => \common\models\Ticket::find()
                    ->select(['id'])
                    ->where(['user_id' => Yii::$app->user->id])
                    ->column()
        ]);
        TicketComments::updateAll([
            'status' => TicketComments::STATUS_READ
                ], [
            'ticket_comments.id' => \common\models\TicketComments::find()
                    ->select(['ticket_comments.id'])
                    ->replies(Yii::$app->user->id)
                    ->column()
        ]);
        return $this->renderPartial('/layouts/parts/_new-comments');
    }

}
