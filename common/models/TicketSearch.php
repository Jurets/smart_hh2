<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Ticket;

/**
 * TicketSearch represents the model behind the search form about `common\models\Ticket`.
 */
class TicketSearch extends Ticket {

    /**
     * @inheritdoc
     */
    /*
     *  params
     */


    /*
     * Extence params
     */
    public $price_filter;
    public $jobs_within;
    public $currency;
    public $location;

    public function rules() {
        return [
            [['id', 'user_id', 'id_category', 'price', 'is_turned_on', 'status', 'is_time_enable', /* 'performer_id', */ 'is_positive', 'rate'], 'integer'],
            [['description', 'title', 'created', 'system_key', 'start_day', 'finish_day', 'comment'], 'safe'],
            /* advanced search for the frontend */
            [['price_filter', 'jobs_within'], 'integer'],
            [['currency', 'location',], 'string'],
            [['price_filter', 'jobs_within', 'currency', 'location'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = Ticket::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'id_category' => $this->id_category,
            'price' => $this->price,
            'created' => $this->created,
            'is_turned_on' => $this->is_turned_on,
            'status' => $this->status,
            'is_time_enable' => $this->is_time_enable,
            'start_day' => $this->start_day,
            'finish_day' => $this->finish_day,
            'performer_id' => $this->performer_id,
            'is_positive' => $this->is_positive,
            'rate' => $this->rate,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'system_key', $this->system_key])
                ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }

    /* for frontend only - working with prepared Query Object */

    public static function advancedSearch($get) {
        $model = new TicketSearch;
        $query = Ticket::find();
        $query->distinct(true);
        $query->leftJoin('category_bind', 'ticket.id = ticket_id');
        $srt = 'finish_day ' . $model->getSort($get['sort']);
        
        if (!empty($get['least'])) {
            $query->andWhere('price <= :least', [':least' => (int) $get['least']]);
        }
        if (!empty($get['finish_day'])) {
            $query->andWhere('finish_day <= :fd', [':fd' => $get['finish_day']]);
        }
        $category = [];
        if(isset($get['sub']) && !empty($get['sub'])){
            $buff = array_keys($get['sub']);
            foreach($buff as $cat){
                $category[] = (int)$cat;
            }
            $query->andWhere(['category_bind.category_id' => $category]);
        }else{
            if(isset($get['cid'])){
              $category[] = (int)$get['cid'];
              $query->andWhere(['category_bind.category_id' => $category]);
            }
        }
        if (isset($get['location']) && !empty($get['location']) && isset($get['distance']) && !empty($get['distance'])) {
            $query->distinct(TRUE);
            $model->calculateLatLon($get['location']);
            $mylon = $model->lon;
            $mylat = $model->lat;
            $dist = (int)$get['distance'];

            $lon1 = $mylon - $dist / abs(cos(deg2rad($mylat)) * 69);
            $lon2 = $mylon + $dist / abs(cos(deg2rad($mylat)) * 69);
            $lat1 = $mylat - ($dist / 69);
            $lat2 = $mylat + ($dist / 69);

            $query->andWhere(['between', 'lon', $lon1, $lon2]);
            $query->andWhere(['between', 'lat', $lat1, $lat2]);
        }
        return $query;
    }

}
