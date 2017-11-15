<?php

namespace backend\modules\metal\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\metal\models\MetalRates;

/**
 * MetalRatesSearch represents the model behind the search form about `backend\modules\metal\models\MetalRates`.
 */
class MetalRatesSearch extends MetalRates
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'metal_id'], 'integer'],
            [['date'], 'safe'],
            [['price'], 'number'],
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
        $query = MetalRates::find();

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
            'metal_id' => $this->metal_id,
            'date' => $this->date,
            'price' => $this->price,
        ]);

        return $dataProvider;
    }
}
