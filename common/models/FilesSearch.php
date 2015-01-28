<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Files;

/**
 * FilesSearch represents the model behind the search form about `common\models\Files`.
 */
class FilesSearch extends Files
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'size', 'user_id'], 'integer'],
            [['name', 'code', 'mimetype', 'description'], 'safe'],
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
    public function search($params, $desc_filter=NULL)
    {
        $query = Files::find();
        if(!is_null($desc_filter) && is_array($desc_filter)){
            $query->andFilterWhere($desc_filter);
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'size' => $this->size,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'mimetype', $this->mimetype])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
