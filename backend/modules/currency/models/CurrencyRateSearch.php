<?php

namespace backend\modules\currency\models;

use common\classes\Debug;
use common\models\db\CurrencyRate;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CurrencyRateSearch represents the model behind the search form about `backend\modules\currency\models\CurrencyRate`.
 */
class CurrencyRateSearch extends CurrencyRate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'currency_from_id', 'currency_to_id'], 'integer'],
            [['date'], 'safe'],
            [['rate'], 'number'],
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

        $query = CurrencyRate::find();


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
            'date' => $this->date,
            'currency_from_id' => $this->currency_from_id,
            'currency_to_id' => $this->currency_to_id,
            'rate' => $this->rate,
        ]);


        return $dataProvider;
    }
}
