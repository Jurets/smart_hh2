<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserSocialNetwork;

/**
 * UserSocialNetworkSearch represents the model behind the search form about `common\models\UserSocialNetwork`.
 */
class UserSocialNetworkSearch extends UserSocialNetwork
{
    public $user;
    public $socialNetwork;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['social_network_id', 'user_id', 'moderate'], 'integer'],
            [['url', 'user', 'socialNetwork'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = UserSocialNetwork::find();
        $query->joinWith(['user', 'socialNetwork']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['user'] = [
            'asc' => ['user.email' => SORT_ASC],
            'desc' => ['user.email' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['socialNetwork'] = [
            'asc' => ['social_network.title' => SORT_ASC],
            'desc' => ['social_network.title' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'moderate' => $this->moderate,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url]);
        $query->andFilterWhere(['like', 'user.email', $this->user]);
        $query->andFilterWhere(['like', 'social_network.title', $this->socialNetwork]);

        return $dataProvider;
    }
}
