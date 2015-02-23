<?php

namespace frontend\controllers;

use Yii;
use common\models\Ticket;
use common\models\TicketSearch;
use common\models\Category;
use common\modules\user\models\User;
use common\models\Proposal;
use yii\data\ActiveDataProvider;
#use yii\web\Controller;
use common\components\Controller; // with auto ban state control
use common\components\GoogleApiHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Complaint;
use yii\helpers\Url;
use common\components\UserActivity;
use common\models\Offer;

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
            'Customer' => 'index create view review update test delete complain renderloginform renderapplyform priceagreement apply offer-price set-as-done add-comment delete-comment accept-offer performer-accept-offer',
            'Performer' => 'index create view review update test complain delete complain renderloginform renderapplyform priceagreement apply offer-price set-as-done add-comment delete-comment performer-accept-offer',
            'Guest' => 'index test create-toLogin review-toLogin renderloginform', // if Guest then redirect to login action
        ];
    }

    /**
     * Lists all Ticket models.
     * @return mixed
     */
    public function actionIndex($cid = NULL) {
        $get = Yii::$app->request->get();
        $query = Ticket::find()->andFilterWhere([
            'not',
            [
                'ticket.status' => [
                    Ticket::STATUS_COMPLETED,
                ]
            ]
        ]);
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
        $model = $this->findModel($id);
        $this->checkTicketExistence($model);
        $this->isTicketsOwner($model);
        //$proposeModel = new Proposal; // get a proposal model
        //$proposes = $proposeModel->getAllProposes($model->id);
        $proposes = $model->getReplies();
        $get = Yii::$app->request->get();
        $isAutoFocus = isset($get['reply']) && $get['reply'];
        $complain = new Complaint;
        return $this->render('view', [
                    'model' => $model,
                    'proposal' => $proposes,
                    'isAutoFocus' => $isAutoFocus,
                    'complain' => $complain
        ]);
    }
    public function actionPriceagreement(){
        if(Yii::$app->request->isAjax){
            $post = Yii::$app->request->post();
            $id = isset($post['ticket_id']) ? int($post['ticket_id']) : NULL;
            $model = $this->findModel($id);
            $this->checkTicketExistence($model);
            // TO DO : CustomerSign & PerformerSign
            
        }
    }
    public function actionReview($id) {
        $model = $this->findModel($id);
        $this->checkTicketExistence($model);
        $user = User::findOne(['id' => $model->user_id]);
        $applied = false;
        if (!is_null($model)) {
            $complain = new Complaint;
            $offer = Offer::findCurrentOffer(Yii::$app->user->id, $model->id);
            $proposalModel = new Proposal;
            $propose = $proposalModel->findPropose($model->id, Yii::$app->user->id);
            if(!is_null($propose)){
                $applied = true;
            }
            $newPrice = [];
            if(!is_null($offer)){
                $buff = $offer->getOfferHistoryLast();
                $stage = is_null($offer) ? NULL : $offer->stage;
                $newPrice['price'] = is_null($buff) ? NULL : $buff->price;
                switch($stage){
                    case Offer::STAGE_OWNER_OFFER:
                    case Offer::STAGE_COUNTEROFFER:
                        $newPrice['message'] = Yii::t('app', 'Owner offered');
                        break;
                    case Offer::STAGE_LAST_ANSWER:
                        $newPrice['message'] = Yii::t('app', 'You offered');
                        break;
                    case Offer::STAGE_AGREE:
                        $newPrice['message'] = Yii::t('app', 'Agreed on');
                        break;
                    default:
                        $newPrice['message'] = Yii::t('app', 'Ready to raise on');
                }
                //$applied = true;
            }else{
                if(!is_null($propose)){
                    $newPrice['price'] = $propose->price;
                    $newPrice['message'] = Yii::t('app', 'You offered');
                }else{
                    $price = $model->price;
                }
            }
            return $this->render('review', [
                        'model' => $model,
                        'user' => $user,
                        'complain' => $complain,
                        'price' => $model->price,
                        'newPrice' => $newPrice,
                        'stage' => isset($stage) ? $stage : NULL,
                        'applied' => $applied
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
        $this->isTicketsOwner($model);
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
     
     * @return mixed
     */
    public function actionDelete() {
        $post = Yii::$app->request->post();
        $id = NULL;
        if (isset($post['id']) && !is_null($post['id'])) {
            $id = (int) $post['id'];
            $model = $this->findModel($id);
            $this->isTicketsOwner($model);
            $model->delete();
            $this->redirect('/');
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

    public function actionTest($id=NULL) {
        $offer = Offer::findCurrentOffer(Yii::$app->user->id, $id);
        //return $this->render('test');
    }

    /* purposal work */

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
                    echo json_encode(['usr' => Yii::$app->user->id, 'head' => $head]);
                } else {
                    $error = $this->renderErrors($model->errors);
                    $errJs = ['err' => $error];
                    echo json_encode($errJs);
                }
            }
        }
    }

    public function actionRenderapplyform() {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            $id = (isset($post['ticket_id']) && !is_null($post['ticket_id'])) ? (int) $post['ticket_id'] : NULL;
            if (is_null($id)) {
                throw new NotFoundHttpException('unknown proposal');
            }
            $ticket = Ticket::findOne(['id' => $id]);
            if (isset($post['render'])) {
                echo $this->renderPartial('popup/_apply', ['price' => $ticket->price]);
            } else {
                /* apply */
                $from_user_id = (isset($post['performer_id']) && !is_null($post['performer_id'])) ? (int) $post['performer_id'] : NULL;
                if (is_null($from_user_id)) {
                    throw new NotFoundHttpException('unknown user');
                }
                $this->applyMain($from_user_id, $ticket, $post);
            }
        }
    }
    
    public function actionApply() {
        $post = Yii::$app->request->post();
        $id = (isset($post['ticket_id'])) ? (int) $post['ticket_id'] : null;
        if (is_null($id)) {
            throw new NotFoundHttpException('unknown proposal');
        }
        $ticket = Ticket::findOne(['id' => $id]);
        /* apply */
        $from_user_id = (isset($post['performer_id'])) ? (int) $post['performer_id'] : Yii::$app->user->id;
        if (is_null($from_user_id)) {
            throw new NotFoundHttpException('unknown user');
        }
        $this->applyMain($from_user_id, $ticket, $post);
        $this->redirect(['review', 'id' => $id]);
    }
    
    public function actionOfferPrice(){
        $post = Yii::$app->request->post();
        $id = (isset($post['ticket_id'])) ? (int) $post['ticket_id'] : null;
        if (is_null($id)) {
            throw new NotFoundHttpException('unknown proposal');
        }
        $ticket = Ticket::findOne(['id' => $id]);
        /* apply */
        $from_user_id = (isset($post['performer_id'])) ? (int) $post['performer_id'] : Yii::$app->user->id;
        if (is_null($from_user_id)) {
            throw new NotFoundHttpException('unknown user');
        }
        $offer = Offer::findCurrentOffer($from_user_id, $id);
        $proposalModel = new Proposal;
        $propose = $proposalModel->findPropose($id, $from_user_id);
        if(is_null($propose)){
            $this->applyMain($from_user_id, $ticket, $post);
        }else{
            if(is_null($offer)){
                $offer = new Offer();
                $offer->ticket_id = $id;
                $offer->performer_id = $from_user_id;
            }
            $this->offerPriceLastAnswer($offer, $from_user_id, $post);
        }
        $redirectUrl = isset($post['redirect']) ? $post['redirect'] : 'ticket/review';
        $this->redirect([$redirectUrl, 'id' => $id]);
    }
    
    public function actionSetAsDone(){
        $post = Yii::$app->request->post();
        $ticketId = isset($post['ticket_id']) ? $post['ticket_id'] : null;
        $ticket = Ticket::findOne($ticketId);
        if(isset($post['isOwnTicket']) && $post['isOwnTicket']){
            $this->isTicketsOwner($ticket);
            $review = new \common\models\Review();
            $review->load($post);
            $review->ticket_id = $ticketId;
            $review->save();
            $ticket->status = Ticket::STATUS_COMPLETED;
            Offer::updateAll(['stage' => Offer::ARCHIVED], ['ticket_id' => $ticket->id]);
            Proposal::updateAll(['archived' => 1], ['ticket_id' => $ticket->id]);
        }else{
            if($ticket->performer_id != Yii::$app->user->id){
                throw new \yii\web\HttpException('403', 'Permission denied. You are not allowed to execute this action');
            }
            $ticket->status = Ticket::STATUS_DONE_BY_PERFORMER;
        }
        $ticket->save();
        $this->redirect(['ticket/review', 'id' => $ticket->id]);
    }
    
    public function actionAddComment(){
        $post = Yii::$app->request->post();
        $comment = new \common\models\TicketComments();
        $comment->load($post);
        if($comment->save() && !is_null($comment->answer_to)){
        \common\models\TicketComments::updateAll([
            'status' => \common\models\TicketComments::STATUS_READ
                ], ['id' => $comment->answer_to]);
        }
        $redirectUrl = isset($post['redirect']) ? $post['redirect'] : 'ticket/review';
        $this->redirect([$redirectUrl, 'id' => $comment->ticket_id]);
    }
    
    public function actionDeleteComment(){
        $post = Yii::$app->request->post();
        $id = isset($post['comment_id']) ? $post['comment_id'] : null;
        $redirect = ['ticket/index'];
        if($id !== null){
            $comment = \common\models\TicketComments::findOne($id);
            if($comment !== null){
                $redirect = ['ticket/view', 'id' => $comment->ticket_id];
                $comment->delete();
            }
        }
        $this->redirect($redirect);
    }
    
    public function actionAcceptOffer(){
        $post = Yii::$app->request->post();
        $ticketId = isset($post['ticket_id']) ? $post['ticket_id'] : null;
        $performerId = isset($post['performer_id']) ? $post['performer_id'] : null;
        $price = isset($post['price']) ? $post['price'] : null;
        if($ticketId === null || $performerId === null){
            throw new \yii\web\HttpException('404');
        }
        $ticket = Ticket::findOne($ticketId);
        $this->checkTicketExistence($ticket);
        $this->isTicketsOwner($ticket);
        $performer = User::findOne($performerId);
        if($performer === null){
            throw new \yii\web\HttpException('404');
        }
        $offer = Offer::findOne([
            'ticket_id' => $ticketId,
            'performer_id' => $performerId
        ]);
        if($offer === null){
            $offer = new Offer();
            $offer->ticket_id = $ticketId;
            $offer->performer_id = $performerId;
        }
        $offer->stage = Offer::STAGE_AGREE;
        if($offer->save()){
            $offerHistory = new \common\models\OfferHistory();
            $offerHistory->offer_id = $offer->id;
            $offerHistory->price = $price;
            $offerHistory->note = Yii::t('app', 'agreed');
            $offerHistory->save();            
        }
        $ticket->performer_id = $performerId;
        $ticket->save();
        $this->redirect(['ticket/view', 'id' => $ticket->id]);
    }
    
    public function actionPerformerAcceptOffer(){
        $post = Yii::$app->request->post();
        $ticketId = isset($post['ticket_id']) ? $post['ticket_id'] : null;
        $performerId = isset($post['performer_id']) ? $post['performer_id'] : Yii::$app->user->id;
        $price = isset($post['price']) ? $post['price'] : null;
        if($ticketId === null || $performerId === null){
            throw new \yii\web\HttpException('404');
        }
        $ticket = Ticket::findOne($ticketId);
        $this->checkTicketExistence($ticket);
        $performer = User::findOne($performerId);
        if($performer === null){
            throw new \yii\web\HttpException('404');
        }
        $offer = Offer::findOne([
            'ticket_id' => $ticketId,
            'performer_id' => $performerId
        ]);
        if($offer === null){
            throw new \yii\web\HttpException('404');
        }
        $offer->stage = Offer::STAGE_AGREE;
        if($offer->save()){
            $offerHistory = new \common\models\OfferHistory();
            $offerHistory->offer_id = $offer->id;
            $offerHistory->price = $price;
            $offerHistory->note = Yii::t('app', 'agreed');
            $offerHistory->save();            
        }
        $ticket->performer_id = $performerId;
        $ticket->save();
        $this->redirect(['ticket/review', 'id' => $ticket->id]);
    }

    /* _ */

    protected function checkTicketExistence($model) {
        if (is_null($model))
            throw new \yii\web\HttpException('404');
        return TRUE;
    }

    protected function applyMain($from_user_id, $ticket, $post) {
        $proposalModel = new Proposal;
        if ($proposalModel->checkProposeExist($ticket->id, $from_user_id)) {
            echo $this->jsonStrMake(['err' => Yii::t('app', 'You alredy apply this ticket')]);
        } else {
            // create the new propose record
                // we getting price from responce
                $price = (isset($post['price']) && !empty($post['price']) && $post['price'] != 0)
                        ? (float) $post['price']
                        : (!is_null($ticket->price) ? $ticket->price : 0);
            $this->proposalProcess($proposalModel, $from_user_id, $ticket->id, $price);
            echo $this->jsonStrMake(['msg' => Yii::t('app', 'Apply this job successfull')]);
        }
    }
    
    protected function offerPriceLastAnswer($offer, $performerId, $post){
        $price = (isset($post['price']) && !empty($post['price']) && $post['price'] != 0) ? (float) $post['price'] : 0;
        $offer->stage = isset($post['stage']) ? $post['stage'] : Offer::STAGE_LAST_ANSWER;
        if($offer->save()){
            $offerHistory = new \common\models\OfferHistory();
            $offerHistory->offer_id = $offer->id;
            $offerHistory->price = $price;
            $offerHistory->note = Yii::t('app', 'I offer new price');
            $offerHistory->save();
        }
    }

    protected function jsonStrMake($arr) {
        if (!is_array($arr)) {
            throw new NotFoundHttpException('jsonStrMake param mast be an array');
        }
        return json_encode($arr);
    }

    protected function proposalProcess($model, $performer_id, $ticket_id, $price) {
        $model->performer_id = $performer_id;
        $model->ticket_id = $ticket_id;
        $model->message = Yii::t('app', 'check out my position');
        $model->price = $price;
        if ($model->validate()) {
            $model->save(false);
            // TO DO send letter to customer logic
        } else {
            throw new NotFoundHttpException('uncorrect external price');
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
            throw new \yii\web\HttpException('403', 'Permission denied are not allowed to execute this action');
        }
    }

}
