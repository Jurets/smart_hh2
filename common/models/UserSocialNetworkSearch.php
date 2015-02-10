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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['social_network_id', 'user_id', 'moderate'], 'integer'],
            [['url'], 'safe'],
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

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'social_network_id' => $this->social_network_id,
            'user_id' => $this->user_id,
            'moderate' => $this->moderate,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
