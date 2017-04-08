<?php

namespace backend\modules\exchange_rates\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\exchange_rates\models\ExchangeRates;

/**
 * ExchangeRatesSearch represents the model behind the search form about `backend\modules\exchange_rates\models\ExchangeRates`.
 */
class ExchangeRatesSearch extends ExchangeRates
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'up'], 'integer'],
            [['currencies', 'buy', 'sale'], 'safe'],
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
        $query = ExchangeRates::find();

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
            'type_id' => $this->type_id,
            'up' => $this->up,
        ]);

        $query->andFilterWhere(['like', 'currencies', $this->currencies])
            ->andFilterWhere(['like', 'buy', $this->buy])
            ->andFilterWhere(['like', 'sale', $this->sale]);

        return $dataProvider;
    }
}
