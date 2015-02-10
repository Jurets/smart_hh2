<?php

namespace frontend\controllers;

use Yii;
use common\models\Ticket;
use common\models\TicketSearch;
use common\models\Category;
use yii\data\ActiveDataProvider;
#use yii\web\Controller;
use common\components\Controller; // with auto ban state control
use common\components\GoogleApiHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Complaint;
use yii\helpers\Url;
use common\components\UserActivity;

/**
 * TicketController implements the CRUD actions for Ticket model.
 */
class TicketController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function convensionInit() {
        return [
            'Customer' => 'index create view review update test delete complain renderloginform',
            'Performer' => 'index view review complain renderloginform',
            'Guest' => 'index test review create-toLogin renderloginform', // if Guest then redirect to login action
        ];
    }

    /**
     * Lists all Ticket models.
     * @return mixed
     */
    public function actionIndex($cid = NULL) {
        $get = Yii::$app->request->get();
        $query = Ticket::find();
        if (isset($get['cid'])) {
            $query->leftJoin('category_bind', 'ticket.id = ticket_id');
            $query->andFilterWhere(['category_bind.category_id' => (int) $cid]);
        }
        if ($get && isset($get['sort'])) {
            unset($query);
            $query = TicketSearch::advancedSearch($get);
        }
        $list = Yii::$app->params['languages'];
        $apiKey = Yii::$app->params['apiLanguages'];

        $category = new Category;
        $categories = $category->categoryOutput($cid);

        $query->andWhere(['is_turned_on' => Ticket::TURNED_ON]);
        $query->with('user')->with('user.profile')->with('user.profile.files');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'list' => $list,
                    'apiKey' => $apiKey,
                    'categories' => $categories,
        ]);
    }

    /**
     * Displays a single Ticket model.
     * @param integer $id
     * @return mixed
     */
    public function actionCreate() {
        /* Guest to login section */
//        if (Yii::$app->user->isGuest) {
//            if (Yii::$app->urlManager->enablePrettyUrl === TRUE) {
//                $this->redirect(Url::to('/user/login'), TRUE);
//            }
//            $this->redirect(Url::to('/?r=user/login'), TRUE);
//        }

        $model = new Ticket();
        $post = Yii::$app->request->post();
        if (!empty($post)) {
            // run creation main service
            if ($model->mainInitService($post))
                $this->redirect(['view', 'id' => $model->id]);
        }
        $categories = $model->categoryLocate();
        return $this->render('create', [
                    'model' => $model,
                    'categories' => $categories,
        ]);
    }

    public function actionView($id) {
        $model = Ticket::findOne(['id' => $id]);
        // only owner has access
        $this->isTicketsOwner($model);
        if (!is_null($model)) {
            return $this->render('view', ['model' => $model]);
        } else {
            throw new \yii\web\HttpException('404');
        }
    }

    public function actionReview($id) {
        $model = Ticket::findOne(['id' => $id]);
        $user = \common\modules\user\models\User::findOne(['id' => $model->user_id]);
        if (!is_null($model)) {
            $complain = new Complaint;
            return $this->render('review', [
                        'model' => $model,
                        'user' => $user,
                        'complain' => $complain
            ]);
        } else {
            throw new \yii\web\HttpException('404');
        }
    }

    /**
     * Updates an existing Ticket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (Yii::$app->user->id !== $model->user_id) {
            return $this->redirect('/');
        }
        $post = Yii::$app->request->post();
        if ($post && $model->mainInitService($post, TRUE)) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $categories = $model->categoryLocate();
        $exists = $model->catsExist();
        return $this->render('update', [
                    'model' => $model,
                    'categories' => $categories,
                    'exists' => $exists,
        ]);
    }

    /**
     * Deletes an existing Ticket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete() {
        $post = Yii::$app->request->post();
        $id = NULL;
        if (isset($post['id']) && !is_null($post['id'])) {
            $id = (int) $post['id'];
            $model = $this->findModel($id);
            if (Yii::$app->user->id !== $model->user_id) {
                return $this->redirect('/');
            } else {
                $model->delete();
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ticket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ticket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    /* action complain */
    public function actionComplain() {
        $complain = new Complaint;
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            $complain->attributes = $post;
            if (!$complain->validate()) {
                return $this->renderErrors($complain->errors);
            } else {
                if ($this->complainAllreadySend($complain->ticket_id)) {
                    return Yii::t('app', 'You have already complained');
                }
                $complain->save(false);
                $this->turnOffTicket($complain);
                return Yii::t('app', 'Complain send Success');
            }
        }
    }

    public function actionTest() {
        echo 'Test is ok';
    }

    public function actionRenderloginform() {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            $model = Yii::$app->getModule("user")->model("LoginForm");
            if (empty($post)) {
                echo $this->renderPartial('popup/_login', ['model' => $model]);
            } else {
                /* autenticate */
                if ($model->load($post) && $model->login(Yii::$app->getModule("user")->loginDuration)) {
                    UserActivity::changeNetworkStatus(Yii::$app->user->id, 'on');
                    $head = $this->renderPartial('/layouts/parts/header_login');
                    echo json_encode(['usr'=>Yii::$app->user->id, 'head'=>$head]);
                }else{
                    $error = $this->renderErrors($model->errors);
                    $errJs = ['err' => $error];
                    echo json_encode($errJs);
                }
            }
        }
    }

    protected function renderErrors($errors) {
        $message = '';
        foreach ($errors as $error) {
            $message .= $error[0] . '<br>';
        }
        return $message;
    }

    protected function turnOffTicket($complain, $number = 3) {
        $count = Complaint::howManyComplains($complain->ticket_id);
        if ($count >= $number) {
            $ticket = Ticket::findOne(['id' => $complain->ticket_id]);
            $ticket->is_turned_on = Complaint::STATUS_OFF;
            $ticket->save();
            Yii::$app->mailer->compose('complaint/ban', ['ticketId' => $complain->ticket_id])
                    ->setTo($complain->ticket->user->email)
                    ->setSubject('ticket ban')
                    ->send();
        }
    }

    protected function complainAllreadySend($ticket_id) {
        if (Complaint::findOne([
                    'ticket_id' => $ticket_id,
                    'status' => Complaint::STATUS_OFF,
                    'from_user_id' => Yii::$app->user->id,
                ]) !== null) {
            return true;
        }
        return false;
    }

    protected function findModel($id) {
        if (($model = Ticket::findOne(['id' => $id, 'is_turned_on' => Ticket::TURNED_ON])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function isTicketsOwner($model) {
        if ($model->user_id != Yii::$app->user->id) {
            throw new \yii\web\HttpException('403', 'Permission denied are not allowed to view the page');
        }
    }
}
