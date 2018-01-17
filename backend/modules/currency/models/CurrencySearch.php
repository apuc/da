<?php

namespace backend\modules\currency\models;

use common\models\db\Currency;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CurrencySearch represents the model behind the search form about `backend\modules\currency\models\Currency`.
 */
class CurrencySearch extends Currency
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'code', 'status', 'type', 'nominal'], 'integer'],
            [['name', 'char_code'], 'safe'],
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
        $query = Currency::find();

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
            'code' => $this->code,
            'nominal' => $this->nominal,
            'status' => $this->status,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'char_code', $this->char_code]);

        return $dataProvider;
    }
}
