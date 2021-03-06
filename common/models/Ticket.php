<?php

namespace common\models;

use Yii;
use yii\db\Query;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use common\modules\user\models\User;
use common\models\Zips;

/* message: curl-adapt : ok */

/**
 * This is the model class for table "ticket".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $id_category
 * @property string $description
 * @property string $title
 * @property integer $price
 * @property string $created
 * @property integer $is_turned_on
 * @property string $system_key
 * @property integer $status
 * @property integer $is_time_enable
 * @property string $start_day
 * @property string $finish_day
 * @property string $comment
 * @property integer $is_positive
 * @property integer $rate
 * @property string $updated_at
 * @property string $job_location
 * @property integer $assembled_zip
 * 
 * @property Category $category
 * @property User $user
 * @property TicketComments[] $ticketComments
 * @property Review[] $reviews
 * 
 * @property string $photo
 */
class Ticket extends \yii\db\ActiveRecord {

    private $_commentHierarchy;
    private $_replies;
    private $_canAcceptOffer;
    public $file_prepare;
    public $location;
    public $comments_count;

    // bann (is turned on check)
    // Field is_turned_on 
    const TURNED_OFF = 0;
    const TURNED_ON = 1;
    //Field status
    const STATUS_COMPLETED = 0;
    const STATUS_EXPIRED = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_NOT_COMPLETED = 3;
    const STATUS_COMPLETED_WITH_COMMENT = 4;
    const STATUS_DONE_BY_PERFORMER = 5;
    //Field is_time_enable
    const STATUS_TIME_OFF = 0;
    const STATUS_TIME_ON = 1;
    const WITHOUT_COMMENT = 0;
    const WITH_COMMENT = 1;

    /**
     * @inheritdoc
     */
    public $categoryBinds = []; // get and check category instances for category binding when ticket create 
    
    public $msg = []; // messages pool for assembled_zip validation

    public static function tableName() {
        return 'ticket';
    }

    public function init() {
        parent::init();
        $this->msg = [
            'zero' => Yii::t('app', 'Zip code must be not null'),
            'five' => Yii::t('app', 'Zip code consist of five digits'),
            'range' => Yii::t('app', 'zip out of the range of addresses served'),
            'mailto' => Yii::t('app', "if you want Helping Hut in your city write to us"),
        ];
    }
    
    /* serves as a substitute for native values comfy  (Extensible) */

    protected $surrogateStruct = [
        'is_turned_on' => [
            self::TURNED_OFF => 'Banned',
            self::TURNED_ON => 'Active',
        ],
        'status' => [
            self::STATUS_DONE_BY_PERFORMER => 'Done By Performer',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_EXPIRED => 'Expired',
            self::STATUS_PROCESSING => 'In processing',
            self::STATUS_NOT_COMPLETED => 'Not Completed',
            self::STATUS_COMPLETED_WITH_COMMENT => 'Completed and comment exist',
        ],
        'is_time_enable' => [
            self::STATUS_TIME_OFF => 'Without execution time',
            self::STATUS_TIME_ON => 'With execution time',
        ],
    ];

    /* signature sort (convension) */
    protected $sort = [
        0 => 'ASC',
        1 => 'DESC',
    ];

    /* invertor bann/unbann */

    public function bannManager() {
        $this->is_turned_on = ($this->is_turned_on === self::TURNED_OFF) ? self::TURNED_ON : self::TURNED_OFF;
    }

    /* for check bann status in view */

    public function isBanned() {
        return ($this->is_turned_on === self::TURNED_OFF) ? TRUE : FALSE;
    }

    /* (statament:1) handling for surrogateStruct */

    public function getIsTurnedOn() {
        return (!is_null($this->is_turned_on)) ? $this->surrogateStruct['is_turned_on'][(int) $this->is_turned_on] : '';
    }

    public function getStatus() {
        return (!is_null($this->status)) ? $this->surrogateStruct['status'][(int) $this->status] : '';
    }

    public function getIsTimeEnable() {
        return (!is_null($this->is_time_enable)) ? $this->surrogateStruct['is_time_enable'][(int) $this->is_time_enable] : '';
    }

    // Available get the surrogateStruct section (particulary once)
    public function surrogateStructSectionReader($section = 'is_turned_on', $first_empty = false) {
        $options = [];
        if (isset($this->surrogateStruct[$section])) {
            if ($first_empty !== false) {
                $options[NULL] = '';
            }
            $options = array_merge($options, $this->surrogateStruct[$section]);
        }
        return $options;
    }
    // For get city zip by id from zips
    public function getCityZipCode($id){
        $zip = Zips::findOne(['id'=>(int)$id]);
        return $zip->zip;
    }
    /* end of statament:1 */

    /**
     * @inheritdoc
     */
    /*
     * Scenarios 
     */
    public function rules() {
        return [
            [['file_prepare'], 'file', 'extensions' => 'jpg,jpeg, png, gif', 'mimeTypes' => 'image/jpeg, image/png, image/gif'],
            [['user_id', 'id_category', 'description', 'title', 'is_turned_on', 'is_time_enable', 'assembled_zip'], 'required'],
            [['user_id', 'id_category', 'price', 'is_turned_on', 'status', 'is_time_enable', 'is_positive', 'rate', 'zip_id'], 'integer', 'min' => 0],
            [['description', 'comment', 'photo'], 'string'],
            [['lat', 'lon'], 'double'],
            [['created', 'start_day', 'finish_day'], 'safe'],
            [['title', 'system_key'], 'string', 'max' => 255],
            [['assembled_zip'], 'validateAssembledZip'],
        ];
    }

    // custom validators section
    public function validateAssembledZip($attribute, $params) {
        $zip = $this->$attribute;
        // zero check
        if (!$zip) {
            $this->addError($attribute, $this->msg['zero']);
        }
        // 5 digits check
        $zip_str = (string) $zip;
        // patch for shot zip codes
        if(strlen($zip_str) == 4){
            $zip_str = '0'.$zip_str;
        }
        if (!preg_match('/^[0-9][0-9][0-9][0-9][0-9]$/', $zip_str)) {
            $this->addError($attribute, $this->msg['five']);
        }
        // out of range check
        if(!\common\components\Commonhelper::outRangeChecker($zip)){
            $this->addError($attribute, $this->msg['range'].'<br>'.'<a href="mailto:support@helpinghut.com">'.$this->msg['mailto'].'</a>');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User'),
            'id_category' => Yii::t('app', 'Id Category'),
            'description' => Yii::t('app', 'Description'),
            'title' => Yii::t('app', 'Title'),
            'price' => Yii::t('app', 'Price'),
            'created' => Yii::t('app', 'Created'),
            'is_turned_on' => Yii::t('app', 'Is Turned On'),
            'system_key' => Yii::t('app', 'System Key'),
            'status' => Yii::t('app', 'Status'),
            'is_time_enable' => Yii::t('app', 'Is Time Enable'),
            'start_day' => Yii::t('app', 'Start Day'),
            'finish_day' => Yii::t('app', 'Finish Day'),
            'comment' => Yii::t('app', 'Comment'),
            'is_positive' => Yii::t('app', 'Is Positive'),
            'rate' => Yii::t('app', 'Rate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZip() {
        return $this->hasOne(Zips::className(), ['id' => 'zip_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory() {
        return $this->hasOne(Category::className(), ['id' => 'id_category']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketComments() {
        return $this->hasMany(TicketComments::className(), ['ticket_id' => 'id'])->orderBy(['ticket_comments.date' => SORT_ASC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews() {
        return $this->hasMany(Review::className(), ['ticket_id' => 'id']);
    }

    public function getUpdateStatuses() {
        return Offer::getTicketStatusUpdate();
    }

    public function getActiveTickets() {
        return $this->find()->where(['performer_id' => Yii::$app->user->id, 'status' => self::STATUS_NOT_COMPLETED])->all();
        //return $this->find()->where(['performer_id'=>1])->all();
    }

    /* prepare categories-subcategories location struct */

    public function categoryLocate() {
        $locate = (new Query())
                ->select('cat.level lvl, cat.name cat_name, subcat.parent_id pid, subcat.name subcat_name, cat.id cat_id, subcat.id subcat_id')
                ->from('category cat')
                ->leftJoin('category subcat', 'subcat.parent_id = cat.id')
                ->createCommand()
                ->queryAll();
        $compactStruct = [];
        foreach ($locate as $id => $node) {
            if ($node['subcat_id'] != NULL) {
                $compactStruct[$node['cat_id']]['cat_name'] = $node['cat_name'];
                $compactStruct[$node['cat_id']][] = [
                    'subcat_id' => $node['subcat_id'],
                    'subcat_name' => $node['subcat_name'],
                    'parent_id' => $node['pid']
                ];
            } else {
                if ($node['lvl'] == 1) {
                    $compactStruct[$node['cat_id']]['cat_name'] = $node['cat_name'];
                }
            }
        }
        return $compactStruct;
    }

    /* depended from categoryLocate and if updateAction */

    public function catsExist() {
        $existence = (new Query())
                ->select('category_id, parent_id')
                ->from('category_bind')
                ->leftJoin('category', 'category.id = category_bind.category_id')
                ->where(['ticket_id' => $this->id])
                ->createCommand()
                ->queryAll();
        $choiseStruct = [];
        foreach ($existence as $element) {
            if (is_null($element['parent_id'])) {
                $choiseStruct[(string) $element['category_id']] = [];
                $choiseStruct[(string) $element['category_id']][] = $element['category_id']; //'enabled';
            } else {
                $choiseStruct[(string) $element['parent_id']][] = $element['category_id'];
            }
        }
        return $choiseStruct = json_encode($choiseStruct);
    }

    public function ticketUploadFile() {
        $this->photo = UploadedFile::getInstanceByName('photo');

        if ($this->photo && $this->validate()) {
            
        }
    }

    /* Services */
    /* enabled with all dependced data */

    public function mainInitService($post, $mode_update = FALSE) {
        $this->attributes = $post;
        $this->user_id = Yii::$app->user->id;
        $this->status = self::STATUS_NOT_COMPLETED;
        $this->location = $post['location'];
        /* патч для совместимости со старой версией моделей */
        $category = NULL;
        if (isset($post['category'])) {
            $category = $post['category'];
            //$this->id_category = (int) array_search(current($category), $category); // fake binding
            $this->id_category = Category::determinateMainCategory($category);
        } else {
            $this->id_category = NULL;
        }

        $this->is_turned_on = self::TURNED_ON;
        if (!empty($post['location']) || !empty($post['zip-city']) || !empty($post['zip_tf'])) {
            $location = \yii\helpers\Html::encode($post['location']);

            // логика принятия решения по комбинации трех полей
            if (isset($post['zip_ddl'])) { // значит идентифицирован город из базы и пришел его зип посредством выбора в выпадающем списке
                $this->assembled_zip = $this->getCityZipCode((int) $post['zip_ddl']);
                $this->zip_id = (int) $post['zip_ddl'];
            } else { // ветвление для принятия решения по доклеиванию zip
                if (!empty($post['zip_tf'])) {
                    if (ctype_digit(\yii\helpers\Html::encode($post['zip_tf']))) { // человек пытается ввести zip-код как есть
                        $isZip = Zips::find()->where('zip=:zip', ['zip' => (int) $post['zip_tf']])->one(); // мы его пытаемся идентифицировть по базе данных
                        if (!is_null($isZip)) {
                            $this->assembled_zip = $isZip->zip;
                            $this->zip_id = $isZip->id;
                            $this->lat = $isZip->lat;
                            $this->lon = $isZip->lng;
                        } else {
                            $this->assembled_zip = (int) $post['zip_tf'];
                            $this->zip_id = $this->getCityZipCode($this->assembled_zip);
                        }
                    }
                }
            }

            $this->calculateLatLon($location); // google API
            $this->job_location = $location;
        }


        $this->start_day = date('Y-m-d H:i:s');
        if (isset($post['finish_day']) && !empty($post['finish_day'])) {
            $this->finish_day = date('Y-m-d H:i:s', strtotime($post['finish_day']));
            $this->is_time_enable = self::STATUS_TIME_ON;
        } else {
            $this->is_time_enable = self::STATUS_TIME_OFF;
            $this->finish_day = '0000-00-00 00:00:00';
        }
        if (UploadedFile::getInstanceByName('photo') !== NULL) {
            $this->photoPrepare();
        } else {
            // пока без возможности удаления фоторесурса
            //$this->photo = '';
        }
        
        if ($this->validationTest()) {
            $this->save(false);
            $this->photoUploader();
            if ($mode_update === TRUE) {
                $this->categoryUnbindService();
            }
            $this->categoryBindService($category);
            return TRUE;
        }
        return FALSE;
    }

    /* add ticket id (as last insert id) into category_bind */

    protected function categoryBindService($categories) {
        if (is_null($categories)) {
            return;
        }
        $dbc = Yii::$app->db;
        // Need make subcat list for deside to terminate subcat binding after 3
        $categoryOnlyCommand = $dbc->createCommand('SELECT id FROM category WHERE level = 1');
        $onlyCatsIdList = $categoryOnlyCommand->queryColumn();
        $maxSubCatCounter = 0;
        $rows = [];
        foreach ($categories as $catname => $category) {
            if (array_search($catname, $onlyCatsIdList) === FALSE) {
                // this is a subcategory
                $maxSubCatCounter ++;
                if ($maxSubCatCounter > 3) { // terminate after last 3 subcat
                    continue;
                } else {
                    array_push($rows, [$catname, $this->id]);
                }
            } else { // this is a category
                array_push($rows, [$catname, $this->id]);
            }
        }
        $mainCom = $dbc->createCommand()
                ->batchInsert('category_bind', ['category_id', 'ticket_id'], $rows);
        $mainCom->execute();
    }

    /* remove old categories when ticket edit */

    protected function categoryUnbindService() {
        $dbc = Yii::$app->db;
        $mainCom = $dbc->createCommand()
                ->delete('category_bind', ['ticket_id' => $this->id]);
        $mainCom->execute();
    }

    /* photoUploadService */

    protected function photoPrepare() {
        $this->file_prepare = UploadedFile::getInstanceByName('photo');
        $this->photo = $this->getUniqName($this->file_prepare->baseName) .
                '.' . $this->file_prepare->extension;
    }

    protected function photoUploader() {
        if (!is_null($this->file_prepare))
            $this->file_prepare->saveAs(Yii::$app->params['upload.path'] . DIRECTORY_SEPARATOR . $this->photo);
    }

    /* calculate and set longitude-latitude by Google API */

    protected function calculateLatLon($location) {
        if(!is_null($this->lat) && !is_null($this->lon)){
            return 0;
        }
        $location = $this->assembled_zip . ' ' . $location;
        $address = str_replace(' ', '+', $location);
        $constPartUrl = 'https://maps.googleapis.com/maps/api/geocode/xml?key=' .
                Yii::$app->params['GoogleAPI'];
        $url = $constPartUrl . '&address=' . $address;
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($handle, CURLOPT_TIMEOUT, 5);
        $container = curl_exec($handle);
        curl_close($handle);

        $object = @simplexml_load_string($container);
        if (isset($object->result->geometry)) {
            $this->lat = (float) $object->result->geometry->location->lat;
            $this->lon = (float) $object->result->geometry->location->lng;
        }
    }

    /* validation with preparing error message */

    protected function validationTest() {
        if ($this->validate() == false) {
            $errDump = '';
            foreach ($this->errors as $error) {
                $errDump .= $error[0] . '<br>';
            }
            Yii::$app->getSession()->setFlash('error', $errDump);
            return FALSE;
        }
        return TRUE;
    }

    /* get unique hash */

    protected function getUniqName($addition) {
        $str = date('d.m.Y H:i:s') . $addition;
        $hash_arr = str_split(md5($str), 1);
        shuffle($hash_arr);
        $name = join('', $hash_arr);
        return 'ticket_' . substr($name, 0, 20);
    }

    public function getSort($sort) {
        return $this->sort[(int) $sort];
    }

    public function delete() {
        $this->categoryUnbindService();
        parent::delete();
    }

    public function beforeSave($insert) {
        $this->updated_at = date('Y-m-d H:i:s');
        return parent::beforeSave($insert);
    }

    public function getCommentsHierarchy() {
        if ($this->_commentHierarchy === null) {
            $this->_commentHierarchy = [];
            foreach ($this->ticketComments as $comment) {
                if (is_null($comment->answer_to)) {
                    $this->_commentHierarchy[$comment->id]['comment'] = $comment;
                } else {
                    $this->_commentHierarchy[$comment->answer_to]['answer'] = $comment;
                }
            }
        }
        return $this->_commentHierarchy;
    }

    /**
     * Get all replies to ticket including proposals and offers
     * @return Reply[] 
     */
    public function getReplies() {
        if ($this->_replies === null) {
            $proposals = Proposal::find()
                    ->where([
                        'ticket_id' => $this->id,
                        'archived' => 0
                    ])
                    ->andWhere([
                        'not exists',
                        (new \yii\db\Query)
                        ->select('offer.id')
                        ->from('offer')
                        ->where('offer.performer_id=proposal.performer_id')
                        ->andWhere(['ticket_id' => $this->id])
                        ->andWhere([
                            'not in',
                            'stage',
                            [
                                Offer::ARCHIVED,
                                Offer::STAGE_OWNER_OFFER,
                            ]
                        ])
                    ])
                    ->all();
            $offers = Offer::find()
                    ->where([
                        'ticket_id' => $this->id,
                    ])
                    ->andWhere([
                        'not in',
                        'stage',
                        [
                            Offer::STAGE_REFUSING,
                            Offer::ARCHIVED,
                            Offer::STAGE_OWNER_OFFER,
                            Offer::STAGE_COUNTEROFFER,
                        ]
                    ])
                    ->all();
            $this->_replies = array_merge($proposals, $offers);
            if (!empty($this->_replies)) {
                yii\helpers\ArrayHelper::multisort($this->_replies, 'date', SORT_DESC);
            }
        }
        return $this->_replies;
    }

    public function canAcceptOffer() {
        if ($this->_canAcceptOffer === null) {
            $this->_canAcceptOffer = $this->is_turned_on && $this->status !== Ticket::STATUS_COMPLETED && $this->status !== Ticket::STATUS_DONE_BY_PERFORMER && !(Offer::find()
                            ->where([
                                'ticket_id' => $this->id,
                                'stage' => Offer::STAGE_AGREE
                            ])
                            ->exists());
        }
        return $this->_canAcceptOffer;
    }

    public function getSimilarTasks() {
        return Ticket::find()
                        ->innerJoin('category_bind', 'ticket.id=category_bind.ticket_id')
                        ->where([
                            'is_turned_on' => 1,
                            'status' => Ticket::STATUS_NOT_COMPLETED,
                        ])
                        ->andWhere(['in', 'category_bind.category_id', (new Query)
                            ->select(['cb.category_id'])
                            ->from(['cb' => 'category_bind'])
                            ->where('cb.ticket_id=:ticketId', [':ticketId' => $this->id])
                        ])
                        ->andWhere(['not', ['ticket.id' => $this->id]])
                        ->orderBy(['created' => SORT_DESC])
                        ->limit(8)
                        ->all();
    }

    public function beforeDelete() {
        if (parent::beforeDelete()) {
            OfferHistory::deleteAll([
                'offer_id' => (new Query)
                        ->select('id')
                        ->from('offer')
                        ->where(['ticket_id' => $this->id])
            ]);
            Offer::deleteAll(['ticket_id' => $this->id]);
            Notification::deleteAll(['entity_id' => $this->id]);
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            Yii::$app->notification->addRottenNotification($this->id, $this->user_id);
        }
        if (array_key_exists('performer_id', $changedAttributes) && $changedAttributes['performer_id'] !== $this->performer_id) {
            Yii::$app->notification->addFdUpNotification($this->id, $this->performer_id);
        }
        if ($this->status !== Ticket::STATUS_NOT_COMPLETED) {
            $types = [
                Notification::TYPE_BELL_FD_UP,
                Notification::TYPE_BELL_ROTTEN,
            ];
            if ($this->status === Ticket::STATUS_COMPLETED) {
                $types = null;
                Yii::$app->notification->markNotificationsAsRead($this->id, 'ticket', null, false, $types);
                TicketComments::updateAll(['status' => TicketComments::STATUS_READ], ['ticket_id' => $this->id]);
            }
            //Yii::$app->notification->markNotificationsAsRead($this->id, 'ticket', null, false, $types);
        }
        if ($this->status === Ticket::STATUS_DONE_BY_PERFORMER && $this->is_turned_on) {
            Yii::$app->notification->addDoneByPerformerNotification($this->id, $this->user_id);
        }
    }

}
