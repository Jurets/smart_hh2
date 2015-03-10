<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FooterContent;

/**
 * FooterContentSearch represents the model behind the search form about `common\models\FooterContent`.
 */
class FooterContentSearch extends FooterContent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang', 'img'], 'integer'],
            [['title', 'reference'], 'safe'],
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
        $query = FooterContent::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'lang' => $this->lang,
            'img' => $this->img,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'reference', $this->reference]);

        return $dataProvider;
    }
    
}
