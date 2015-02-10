<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Ticket;

/**
 * TicketArchiveSearch represents the model behind the search form about `common\models\Ticket`.
 */
class TicketArchiveSearch extends Ticket {

    /**
     * @inheritdoc
     */
    /*
     *  params
     */


    /*
     * Extence params
     */
    public $user;

    public function rules() {
        return [
            [['id', 'user_id', 'id_category', 'price', 'is_turned_on', 'status', 'is_time_enable', /* 'performer_id', */ 'is_positive', 'rate'], 'integer'],
            [['description', 'title', 'created', 'system_key', 'start_day', 'finish_day', 'comment', 'user'], 'safe'],
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
        $query->joinWith(['user']);
        $query->andFilterWhere(['ticket.status' => [
            Ticket::STATUS_COMPLETED,
        ]]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->sort->attributes['user'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];

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
            'ticket.status' => $this->status,
            'is_time_enable' => $this->is_time_enable,
            'start_day' => $this->start_day,
            'finish_day' => $this->finish_day,
            'performer_id' => $this->performer_id,
            'is_positive' => $this->is_positive,
            'rate' => $this->rate,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'user.username', $this->user]);

        return $dataProvider;
    }
}
