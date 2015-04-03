<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Withdrawal;

/**
 * WithdravalSearch represents the model behind the search form about `common\models\Withdrawal`.
 */
class WithdravalSearch extends Withdrawal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'from_user_id', 'completed'], 'integer'],
            [['data', 'method'], 'safe'],
            [['amount'], 'number'],
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
        $query = Withdrawal::find();
        
        $query->andWhere(['completed'=>0]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'data' => $this->data,
            'from_user_id' => $this->from_user_id,
            'amount' => $this->amount,
            'completed' => $this->completed,
        ]);

        $query->andFilterWhere(['like', 'method', $this->method]);

        return $dataProvider;
    }
    
}
