<?php

namespace common\modules\user\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\web\IdentityInterface;
use yii\swiftmailer\Mailer;
use yii\swiftmailer\Message;
use yii\helpers\Inflector;
use yii\helpers\ArrayHelper;
use ReflectionClass;

use common\components\GoogleApiHelper;
use common\models\SocialNetwork;
use common\models\UserSocialNetwork;
use common\models\TicketComments;

/**
 * This is the model class for table "tbl_user".
 *
 * @property string    $id
 * @property string    $role_id
 * @property integer   $status
 * @property string    $email
 * @property string    $new_email
 * @property string    $username
 * @property string    $password
 * @property string    $auth_key
 * @property string    $api_key
 * @property string    $login_ip
 * @property string    $login_time
 * @property string    $create_ip
 * @property string    $create_time
 * @property string    $update_time
 * @property string    $ban_time
 * @property string    $ban_reason
 *
 * @property Profile   $profile
 * @property Role      $role
 * @property UserKey[] $userKeys
 * @property UserAuth[] $userAuths
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @var int Inactive status
     */
    const STATUS_INACTIVE = 0;

    /**
     * @var int Active status
     */
    const STATUS_ACTIVE = 1;

    /**
     * @var int Unconfirmed email status
     */
    const STATUS_UNCONFIRMED_EMAIL = 2;

    /**
     * @var string New password - for registration and changing password
     */
    public $newPassword;

    /**
     * @var string New password confirmation - for reset
     */
    public $newPasswordConfirm;

    /**
     * @var string Current password - for account page updates
     */
    public $currentPassword;

    /**
     * @var array Permission cache array
     */
    protected $_access = [];

    /**
     * @var captcha
     */
    public $verifyCode;
    
    private $_bellNotifications;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return static::getDb()->tablePrefix . "user";
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        // set initial rules
        $rules = [
            // general email and username rules
            [['email', 'username'], 'string', 'max' => 255],
            [['username'], 'required', 'on'=>['register']],
            [['email', 'username'], 'unique'],
            [['email', 'username'], 'filter', 'filter' => 'trim'],
            [['email'], 'email'],
            [['username'], 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => "{attribute} can contain only letters, numbers, and '_'."],

            // password rules
            [['newPassword'], 'string', 'min' => 3],
            [['newPassword'], 'filter', 'filter' => 'trim'],
            [['newPassword'], 'required', 'on' => ['register', 'reset']],
            [['newPasswordConfirm'], 'required', 'on' => ['reset']],
            [['newPasswordConfirm'], 'compare', 'compareAttribute' => 'newPassword', 'message' => 'Passwords do not match'],

            // account page
            [['currentPassword'], 'required', 'on' => ['account']],
            [['currentPassword'], 'validateCurrentPassword', 'on' => ['account']],

            // admin crud rules
            [['role_id', 'status'], 'required', 'on' => ['admin']],
            [['role_id', 'status'], 'integer', 'on' => ['admin']],
            [['ban_time'], 'integer', 'on' => ['admin']],
            [['ban_reason'], 'string', 'max' => 255, 'on' => 'admin'],

            // verifyCode needs to be entered correctly (need for register action)
            array('verifyCode', 'captcha', 'on' => array('register')),
            
            //needed rule for native usermodule registration procedure
            // ('registeruser' - is needed scenario for user (nor customer or performer) registration via action 'user/register')
            array(array('email', 'newPassword'), 'required', 'on' => array('registeruser')),
        ];

        // add required rules for email/username depending on module properties
        $requireFields = ["requireEmail", "requireUsername"];
        foreach ($requireFields as $requireField) {
            if (Yii::$app->getModule("user")->$requireField) {
                $attribute = strtolower(substr($requireField, 7)); // "email" or "username"
                $rules[]   = [$attribute, "required"];
            }
        }

        return $rules;
    }

    /**
     * Validate current password (account page)
     */
    public function validateCurrentPassword()
    {
        if (!$this->verifyPassword($this->currentPassword)) {
            $this->addError("currentPassword", "Current password incorrect");
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('user', 'ID'),
            'role_id'     => Yii::t('user', 'Role ID'),
            'status'      => Yii::t('user', 'Status'),
            'email'       => Yii::t('user', 'Email'),
            'new_email'   => Yii::t('user', 'New Email'),
            'username'    => Yii::t('user', 'Username'),
            'password'    => Yii::t('user', 'Password'),
            'auth_key'    => Yii::t('user', 'Auth Key'),
            'api_key'     => Yii::t('user', 'Api Key'),
            'login_ip'    => Yii::t('user', 'Login Ip'),
            'login_time'  => Yii::t('user', 'Login Time'),
            'create_ip'   => Yii::t('user', 'Create Ip'),
            'create_time' => Yii::t('user', 'Create Time'),
            'update_time' => Yii::t('user', 'Update Time'),
            'ban_time'    => Yii::t('user', 'Ban Time'),
            'ban_reason'  => Yii::t('user', 'Ban Reason'),

            'currentPassword' => Yii::t('user', 'Current Password'),
            'newPassword'     => Yii::t('user', 'New Password'),

            'verifyCode' => Yii::t('user', 'Verification Code'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class'      => 'yii\behaviors\TimestampBehavior',
                'value'      => function () { return date("Y-m-d H:i:s"); },
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'create_time',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time',
                ],
            ],
        ];
    }

    /**
     * Stick with 1 user:1 profile
     *
     * @return \yii\db\ActiveQuery
     */
    /*
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['user_id' => 'id']);
    }
    */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        $profile = Yii::$app->getModule("user")->model("Profile");
        return $this->hasOne($profile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        $role = Yii::$app->getModule("user")->model("Role");
        return $this->hasOne($role::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserKeys()
    {
        $userKey = Yii::$app->getModule("user")->model("UserKey");
        return $this->hasMany($userKey::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAuths()
    {
        return $this->hasMany(UserAuth::className(), ['user_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSocialNetworks()
    {
        return $this->hasMany(UserSocialNetwork::className(), ['user_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(["api_key" => $token]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Verify password
     *
     * @param string $password
     * @return bool
     */
    public function verifyPassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        // hash new password if set
        if ($this->newPassword) {
            $this->password = Yii::$app->security->generatePasswordHash($this->newPassword);
        }

        // convert ban_time checkbox to date
        if ($this->ban_time) {
            $this->ban_time = date("Y-m-d H:i:s");
        }

        // ensure fields are null so they won't get set as empty string
        $nullAttributes = ["email", "username", "ban_time", "ban_reason"];
        foreach ($nullAttributes as $nullAttribute) {
            $this->$nullAttribute = $this->$nullAttribute ? $this->$nullAttribute : null;
        }

        return parent::beforeSave($insert);
    }

    /**
     * Set attributes for registration
     *
     * @param int    $roleId
     * @param string $userIp
     * @param string $status
     * @return static
     */
    public function setRegisterAttributes($roleId, $userIp, $status = null)
    {
        // set default attributes
        $attributes = [
            "role_id"   => $roleId,
            "create_ip" => $userIp,
            "auth_key"  => Yii::$app->security->generateRandomString(),
            "api_key"   => Yii::$app->security->generateRandomString(),
            "status"    => static::STATUS_ACTIVE,
        ];

        // determine if we need to change status based on module properties
        $emailConfirmation = Yii::$app->getModule("user")->emailConfirmation;
        $requireEmail      = Yii::$app->getModule("user")->requireEmail;
        $useEmail          = Yii::$app->getModule("user")->useEmail;
        if ($status) {
            $attributes["status"] = $status;
        }
        elseif ($emailConfirmation && $requireEmail) {
            $attributes["status"] = static::STATUS_INACTIVE;
        }
        elseif ($emailConfirmation && $useEmail && $this->email) {
            $attributes["status"] = static::STATUS_UNCONFIRMED_EMAIL;
        }

        // set attributes and return
        $this->setAttributes($attributes, false);
        return $this;
    }

    /**
     * Check and prepare for email change
     *
     * @return bool True if user set a `new_email`
     */
    public function checkAndPrepEmailChange()
    {
        // check if user is removing email address (only if Module::$requireEmail = false)
        if (trim($this->email) === "") {
            return false;
        }

        // check for change in email
        if ($this->email != $this->getOldAttribute("email")) {

            // change status
            $this->status = static::STATUS_UNCONFIRMED_EMAIL;

            // set `new_email` attribute and restore old one
            $this->new_email = $this->email;
            $this->email     = $this->getOldAttribute("email");

            return true;
        }

        return false;
    }

    /**
     * Update login info (ip and time)
     *
     * @return bool
     */
    public function updateLoginMeta()
    {
        // set data
        $this->login_ip   = Yii::$app->getRequest()->getUserIP();
        $this->login_time = date("Y-m-d H:i:s");

        // save and return
        return $this->save(false, ["login_ip", "login_time"]);
    }

    /**
     * Confirm user email
     *
     * @return bool
     */
    public function confirm()
    {
        // update status
        $this->status = static::STATUS_ACTIVE;

        // update new_email if set
        if ($this->new_email) {
            $this->email     = $this->new_email;
            $this->new_email = null;
        }

        // save and return
        return $this->save(false, ["email", "new_email", "status"]);
    }

    /**
     * Check if user can do specified $permission
     *
     * @param string    $permissionName
     * @param array     $params
     * @param bool      $allowCaching
     * @return bool
     */
    public function can($permissionName, $params = [], $allowCaching = true)
    {
         // check for auth manager rbac
        $auth = Yii::$app->getAuthManager();
        if ($auth) {
            if ($allowCaching && empty($params) && isset($this->_access[$permissionName])) {
                return $this->_access[$permissionName];
            }
            $access = $auth->checkAccess($this->getId(), $permissionName, $params);
            if ($allowCaching && empty($params)) {
                $this->_access[$permissionName] = $access;
            }

            return $access;
        }

        // otherwise use our own custom permission (via the role table)
        return $this->role->checkPermission($permissionName);
    }

    /**
     * Get display name for the user
     *
     * @var string $default
     * @return string|int
     */
    public function getDisplayName($default = "")
    {
        // define possible fields
        $possibleNames = [
            "username",
            "email",
            "id",
        ];

        // go through each and return if valid
        foreach ($possibleNames as $possibleName) {
            if (!empty($this->$possibleName)) {
                return $this->$possibleName;
            }
        }

        return $default;
    }

    /**
     * Send email confirmation to user
     *
     * @param UserKey $userKey
     * @return int
     */
    public function sendEmailConfirmation($userKey)
    {
        /** @var Mailer $mailer */
        /** @var Message $message */

        // modify view path to module views
        $mailer           = Yii::$app->mailer;
        $oldViewPath      = $mailer->viewPath;
        $mailer->viewPath = Yii::$app->getModule("user")->emailViewPath;

        // send email
        $user    = $this;
        $profile = $user->profile;
        $email   = $user->new_email !== null ? $user->new_email : $user->email;
        $subject = Yii::$app->id . " - " . Yii::t("user", "Email Confirmation");
        $message  = $mailer->compose('confirmEmail', compact("subject", "user", "profile", "userKey"))
            ->setTo($email)
            ->setSubject($subject);

        // check for messageConfig before sending (for backwards-compatible purposes)
        if (empty($mailer->messageConfig["from"])) {
            $message->setFrom(Yii::$app->params["adminEmail"]);
        }
        $result = $message->send();

        // restore view path and return result
        $mailer->viewPath = $oldViewPath;
        return $result;
    }

    /**
     * Get list of statuses for creating dropdowns
     *
     * @return array
     */
    public static function statusDropdown()
    {
        // get data if needed
        static $dropdown;
        if ($dropdown === null) {

            // create a reflection class to get constants
            $reflClass = new ReflectionClass(get_called_class());
            $constants = $reflClass->getConstants();

            // check for status constants (e.g., STATUS_ACTIVE)
            foreach ($constants as $constantName => $constantValue) {

                // add prettified name to dropdown
                if (strpos($constantName, "STATUS_") === 0) {
                    $prettyName               = str_replace("STATUS_", "", $constantName);
                    $prettyName               = Inflector::humanize(strtolower($prettyName));
                    $dropdown[$constantValue] = $prettyName;
                }
            }
        }

        return $dropdown;
    }
    
     /* invertor bann/unbann */
    public function banManager(){
        //$this->ban_time = (is_null($this->ban_time)) ? date('Y-m-d H:i:s') : NULL;
        if(is_null($this->ban_time)){
            $this->ban_time = date('Y-m-d H:i:s');
        Yii::$app->mailer->compose('user/ban')
                        ->setTo($this->email)
                        ->setSubject('ban message')
                        ->send();
        }else{
            $this->ban_time = NULL;
        }
    }
    /* for check bann status in view */
    public function isBanned(){
        return ($this->ban_time === NULL) ? FALSE : TRUE;
    }
    
    /* page All Users */
    public function userSearchService(){
       $get = Yii::$app->request->get();
       $query = User::find();
       $query->distinct(TRUE);
       $query->leftJoin('profile', 'user.id = profile.user_id');
       // Specialisation search transfer
       if(isset($get['cid']) && !empty($get['cid'])){
           $query->leftJoin('user_speciality us', 'us.user_id = user.id');
           $query->andFilterWhere(['us.category_id'=>(int)$get['cid']]);
       }
       // form reaction BEGIN
       if(isset($get['max_amount']) && !empty($get['max_amount'])){
           $query->andWhere('profile.hourly_rate <= :ma', [':ma' => (float)$get['max_amount']]);
       }
       // Add Ticket Distance Criteria
       if(isset($get['location']) && !empty($get['location'])){
           $this->distanceSearch($query, $get);
       }
       if(isset($get['rating']) && !empty($get['rating'])){
           $query->andWhere('profile.rating <= :ra', [':ra' => (int)$get['rating']]);
       }
       if(isset($get['done_tasks']) && !empty($get['done_tasks'])){
           $query->andWhere('profile.done_tasks <= :dt', [':dt' => (int)$get['done_tasks']]);
       }
       if(isset($get['created_tasks']) && !empty($get['created_tasks'])){
           $query->andWhere('profile.created_tasks <= :ct', [':ct' => (int)$get['created_tasks']]);
       }
       // form reaction END
       if(!is_null(Yii::$app->user->id)){
           $query->andWhere('user.id <> '.Yii::$app->user->id);
       }
       $query->andWhere('role_id <> 1'); // without admin accaunts
       $query->andWhere('status=:status', [':status'=>1]);
       // Order case
       if(isset($get['sort'])){
           $query->orderBy('profile.hourly_rate'.$this->getSort($get['sort']));
       }
       return $query;
    }
    protected function getSort($sort=0){
        if((int)$sort === 0){
            return ' ASC';
        }
        return ' DESC';
    }
    /* Search service addon for search on the basis of distance */
    protected function distanceSearch($query, $get){
        if(isset($get['within']) && !empty($get['within'])){
            $area = GoogleApiHelper::getSearchSquare($get['location'], (int)$get['within']);
            if(!is_null($area)){
               $query->leftJoin('ticket', 'user.id = ticket.user_id');
               $query->andWhere(['between', 'ticket.lon', $area['lon1'], $area['lon2']]);
               $query->andWhere(['between', 'ticket.lat', $area['lat1'], $area['lat2']]);
            }
        }
    }
    /**
     * Get list of all social networks either related to current user or not.
     *
     * @return common\models\UserSocialNetwork[]
     */
    public function getAllSocialNetworks(){
        $socialNetworks = SocialNetwork::find()->all();
        $userSocialNetworks = UserSocialNetwork::findAll(['user_id' => $this->id]);
        if(!empty($userSocialNetworks)){
            $userSocialNetworks = ArrayHelper::index($userSocialNetworks, 'social_network_id');
        }
        foreach ($socialNetworks as $socialNetwork){
            if(empty($userSocialNetworks[$socialNetwork->id])){
                $newUserSocialNetwork = new UserSocialNetwork();
                $newUserSocialNetwork->user_id = $this->id;
                $newUserSocialNetwork->social_network_id = $socialNetwork->id;
                $userSocialNetworks[$socialNetwork->id] = $newUserSocialNetwork;
            }
        }
        return $userSocialNetworks;
    }
    
    /**
     * Get list of new comments on user's tickets
     * 
     * @return TicketComments[]
     */
    public function getNewTicketComments(){
        return TicketComments::find()->byUserTickets($this->id)->newComments()->all();
    }
    
    /**
     * Get count of new comments on user's tickets
     * 
     * @return integer
     */
    public function getNewTicketCommentsCount(){
        return TicketComments::find()
                ->byUserTickets($this->id)
                ->newComments()
                ->andWhere(['answer_to' => null])
                ->count();
    }
    
    /**
     * Get count of new comments on user's tickets
     * 
     * @return integer
     */
    public function getNewRepliesCommentsCount(){
        return TicketComments::find()->replies($this->id)->newComments()->count();
    }
    
    public function getTicketsWithNewComments(){
        $newComments =  \common\models\Ticket::find()->select([
            'ticket.id',
            'ticket.title',
            'count(*) as comments_count'
            ])
                ->joinWith('ticketComments')
                ->where([
                    'ticket.user_id' => $this->id,
                    'ticket_comments.status' => TicketComments::STATUS_NEW,
                    'ticket_comments.answer_to' => null,
                        ])
                ->groupBy(['ticket.id', 'ticket.title'])
                ->having('comments_count > 0')
                ->all();
        $newReplies =  \common\models\Ticket::find()->select([
            'ticket.id',
            'ticket.title',
            'count(*) as comments_count'
            ])
                ->joinWith('ticketComments')
                ->joinWith(['ticketComments.parent' => function ($q) {
                        $q->from('ticket_comments parent');
                    }])
                ->where([
                    'parent.user_id' => $this->id,
                    'ticket_comments.status' => TicketComments::STATUS_NEW,
                        ])
                ->groupBy(['ticket.id', 'ticket.title'])
                ->having('comments_count > 0')
                ->all();
        return ['newComments' => $newComments, 'newReplies' => $newReplies];
    }
    
    public function getBellNotifications(){
        if ($this->_bellNotifications === null) {
            $newProposals = (new Query())
                    ->select([
                        'ticket.id',
                        'title',
                        'date' => 'MAX(proposal.date)',
                        'type' => "('bell_proposal')",
                        'proposal_count' => 'count(*)'
                    ])
                    ->from('proposal')
                    ->innerJoin('ticket', 'proposal.ticket_id=ticket.id')
                    ->where([
                        'ticket.user_id' => $this->id,
                        'proposal.archived' => 0
                    ])
                    ->groupBy([
                        'ticket.id',
                        'title',
                        'type'
                    ])
                    ->having('proposal_count > 0')
                    ->all();
            $rottenTickets = (new Query())
                    ->select([
                        'ticket.id',
                        'title',
                        'date' => 'finish_day',
                        'type' => "('bell_rotten')"
                    ])
                    ->from('ticket')
                    ->where([
                        'user_id' => $this->id,
                        'status' => [\common\models\Ticket::STATUS_NOT_COMPLETED],
                        'is_turned_on' => 1,
                    ])
                    ->andWhere('TIMESTAMPDIFF(DAY,CURRENT_TIMESTAMP,finish_day) <= :rottenPeriod', [':rottenPeriod' => Yii::$app->params['bell.rottenTicketDays']])
                    ->andWhere('TIMESTAMPDIFF(DAY,CURRENT_TIMESTAMP,finish_day) >= 0')
                    ->all();
            $fdUpTickets = (new Query())
                    ->select([
                        'ticket.id',
                        'title',
                        'date' => 'finish_day',
                        'type' => "('bell_fd_up')"
                    ])
                    ->from('ticket')
                    ->where([
                        'performer_id' => $this->id,
                        'status' => [\common\models\Ticket::STATUS_NOT_COMPLETED],
                        'is_turned_on' => 1,
                    ])
                    ->andWhere('TIMESTAMPDIFF(DAY,CURRENT_TIMESTAMP,finish_day) <= :rottenPeriod', [':rottenPeriod' => Yii::$app->params['bell.rottenTicketDays']])
                    ->andWhere('TIMESTAMPDIFF(DAY,CURRENT_TIMESTAMP,finish_day) >= 0')
                    ->all();
            $offeredJobs = (new Query())
                    ->select([
                        'ticket.id',
                        'ticket.title',
                        'date' => 'offer_history.date',
                        'type' => "('bell_offered_jobs')",
                    ])
                    ->from('offer_history')
                    ->innerJoin('offer', 'offer_history.offer_id=offer.id')
                    ->innerJoin('ticket', 'offer.ticket_id=ticket.id')
                    ->where([
                        'offer.performer_id' => $this->id,
                        'offer.stage' => \common\models\Offer::STAGE_OWNER_OFFER,
                        'date' => (new Query())
                            ->select('MAX(inner_oh.date)')
                            ->from(['inner_oh' => 'offer_history'])
                            ->where('inner_oh.offer_id=offer.id')
                    ])
                    ->all();
            $acceptedByOwner = (new Query())
                    ->select([
                        'ticket.id',
                        'ticket.title',
                        'date' => 'offer_history.date',
                        'type' => "('bell_accepted_by_owner')",
                    ])
                    ->from('offer_history')
                    ->innerJoin('offer', 'offer_history.offer_id=offer.id')
                    ->innerJoin('ticket', 'offer.ticket_id=ticket.id')
                    ->where([
                        'offer.performer_id' => $this->id,
                        'offer.stage' => \common\models\Offer::STAGE_AGREE,
                        'date' => (new Query())
                            ->select('MAX(inner_oh.date)')
                            ->from(['inner_oh' => 'offer_history'])
                            ->where('inner_oh.offer_id=offer.id')
                    ])
                    ->all();
            $doneByPerformer = (new Query())
                    ->select([
                        'ticket.id',
                        'title',
                        'date' => 'updated_at',
                        'type' => "('bell_done_by_performer')"
                    ])
                    ->from('ticket')
                    ->where([
                        'user_id' => $this->id,
                        'status' => \common\models\Ticket::STATUS_DONE_BY_PERFORMER,
                        'is_turned_on' => 1,
                    ])
                    ->all();
            //TODO Need to review this
            $newReview = (new Query())
                    ->select([
                        'date' => 'date',
                        'type' => "('bell_new_review')"
                    ])
                    ->from('review')
                    ->where([
                        'to_user_id' => $this->id,
                    ])
                    ->andWhere('TIMESTAMPDIFF(DAY,date,CURRENT_TIMESTAMP) < :rottenPeriod', [':rottenPeriod' => Yii::$app->params['bell.rottenTicketDays']])
                    ->andWhere('TIMESTAMPDIFF(DAY,date,CURRENT_TIMESTAMP) >= 0')
                    ->all();
            $performerOfferedNewPrice = (new Query())
                    ->select([
                        'ticket.id',
                        'ticket.title',
                        'user.username',
                        'offer_history.price',
                        'date' => 'offer_history.date',
                        'type' => "('bell_performer_offered_new_price')",
                    ])
                    ->from('offer_history')
                    ->innerJoin('offer', 'offer_history.offer_id=offer.id')
                    ->innerJoin('ticket', 'offer.ticket_id=ticket.id')
                    ->innerJoin('user', 'offer.performer_id=user.id')
                    ->where([
                        'ticket.user_id' => $this->id,
                        'offer.stage' => \common\models\Offer::STAGE_LAST_ANSWER,
                        'date' => (new Query())
                            ->select('MAX(inner_oh.date)')
                            ->from(['inner_oh' => 'offer_history'])
                            ->where('inner_oh.offer_id=offer.id')
                    ])
                    ->all();
        $ownerOfferedNewPrice = (new Query())
                    ->select([
                        'ticket.id',
                        'ticket.title',
                        'user.username',
                        'offer_history.price',
                        'date' => 'offer_history.date',
                        'type' => "('bell_owner_offered_new_price')",
                    ])
                    ->from('offer_history')
                    ->innerJoin('offer', 'offer_history.offer_id=offer.id')
                    ->innerJoin('ticket', 'offer.ticket_id=ticket.id')
                    ->innerJoin('user', 'ticket.user_id=user.id')
                    ->where([
                        'offer.performer_id' => $this->id,
                        'offer.stage' => \common\models\Offer::STAGE_COUNTEROFFER,
                        'date' => (new Query())
                            ->select('MAX(inner_oh.date)')
                            ->from(['inner_oh' => 'offer_history'])
                            ->where('inner_oh.offer_id=offer.id')
                    ])
                    ->all();
            
            $this->_bellNotifications = array_merge(
                    $newProposals,
                    $rottenTickets,
                    $fdUpTickets,
                    $offeredJobs,
                    $acceptedByOwner,
                    $doneByPerformer,
                    $newReview,
                    $performerOfferedNewPrice,
                    $ownerOfferedNewPrice
                    );
            if (!empty($this->_bellNotifications)) {
                yii\helpers\ArrayHelper::multisort($this->_bellNotifications, 'date', SORT_DESC);
            }
        }
        return $this->_bellNotifications;
    }
    
    public function getBellNotificationsCount(){
        return count($this->getBellNotifications());
    }
}