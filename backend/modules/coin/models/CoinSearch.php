<?php

namespace backend\modules\coin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\coin\models\Coin;

/**
 * CoinSearch represents the model behind the search form about `backend\modules\coin\models\Coin`.
 */
class CoinSearch extends Coin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'coin_id', 'fully_premined', 'sort_order', 'sponsored'], 'integer'],
            [['url', 'image_url', 'name', 'symbol', 'coin_name', 'full_name', 'algorithm', 'proof_type'], 'safe'],
            [['total_coin_supply', 'pre_mined_value', 'total_coins_free_float'], 'number'],
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
        $query = Coin::find();

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
            'coin_id' => $this->coin_id,
            'fully_premined' => $this->fully_premined,
            'total_coin_supply' => $this->total_coin_supply,
            'pre_mined_value' => $this->pre_mined_value,
            'total_coins_free_float' => $this->total_coins_free_float,
            'sort_order' => $this->sort_order,
            'sponsored' => $this->sponsored,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'image_url', $this->image_url])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'symbol', $this->symbol])
            ->andFilterWhere(['like', 'coin_name', $this->coin_name])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'algorithm', $this->algorithm])
            ->andFilterWhere(['like', 'proof_type', $this->proof_type]);

        return $dataProvider;
    }
}
