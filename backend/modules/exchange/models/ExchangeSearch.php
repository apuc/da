<?php

namespace backend\modules\exchange\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\exchange\models\Exchange;

/**
 * ExchangeSearch represents the model behind the search form about `backend\modules\exchange\models\Exchange`.
 */
class ExchangeSearch extends Exchange
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'num_code', 'nominal', 'date'], 'integer'],
            [['char_code', 'name'], 'safe'],
            [['value', 'previous'], 'number'],
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
        $query = Exchange::find();

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
            'num_code' => $this->num_code,
            'nominal' => $this->nominal,
            'value' => $this->value,
            'previous' => $this->previous,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'char_code', $this->char_code])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
