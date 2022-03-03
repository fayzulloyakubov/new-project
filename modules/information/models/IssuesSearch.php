<?php

namespace app\modules\information\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\information\models\Issues;

/**
 * IssuesSearch represents the model behind the search form of `app\modules\information\models\Issues`.
 */
class IssuesSearch extends Issues
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['issues_name', 'issues_date', 'issues_content', 'add_info'], 'safe'],
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
        $query = Issues::find();

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
            'issues_date' => $this->issues_date,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', 'issues_name', $this->issues_name])
            ->andFilterWhere(['ilike', 'issues_content', $this->issues_content])
            ->andFilterWhere(['ilike', 'add_info', $this->add_info]);

        return $dataProvider;
    }
}
