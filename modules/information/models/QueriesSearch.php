<?php

namespace app\modules\information\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\information\models\Queries;

/**
 * QueriesSearch represents the model behind the search form of `app\modules\information\models\Queries`.
 */
class QueriesSearch extends Queries
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['queries_name', 'queries_date', 'queries_content', 'add_info'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Queries::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'queries_date' => $this->queries_date,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', 'queries_name', $this->queries_name])
            ->andFilterWhere(['ilike', 'queries_content', $this->queries_content])
            ->andFilterWhere(['ilike', 'add_info', $this->add_info]);
        return $dataProvider;
    }
}
