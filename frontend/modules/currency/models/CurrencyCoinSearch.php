<?php

namespace frontend\modules\currency\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\db\CurrencyCoin;

/**
 * CurrencyCoinSearch represents the model behind the search form of `common\models\db\CurrencyCoin`.
 */
class CurrencyCoinSearch extends CurrencyCoin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'currency_id', 'fully_premined', 'sort_order', 'sponsored'], 'integer'],
            [['url', 'image_url', 'symbol', 'full_name', 'algorithm', 'proof_type', 'total_coin_supply'], 'safe'],
            [['pre_mined_value', 'total_coins_free_float'], 'number'],
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
        $query = CurrencyCoin::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 60
            ]
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
            'currency_id' => $this->currency_id,
            'fully_premined' => $this->fully_premined,
            'pre_mined_value' => $this->pre_mined_value,
            'total_coins_free_float' => $this->total_coins_free_float,
            'sort_order' => $this->sort_order,
            'sponsored' => $this->sponsored,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'image_url', $this->image_url])
            ->andFilterWhere(['like', 'symbol', $this->symbol])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'algorithm', $this->algorithm])
            ->andFilterWhere(['like', 'proof_type', $this->proof_type])
            ->andFilterWhere(['like', 'total_coin_supply', $this->total_coin_supply]);

        return $dataProvider;
    }
}
