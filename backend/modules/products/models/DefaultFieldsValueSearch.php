<?php

namespace backend\modules\products\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\products\models\DefaultFieldsValue;

/**
 * DefaultFieldsValueSearch represents the model behind the search form of `backend\modules\products\models\DefaultFieldsValue`.
 */
class DefaultFieldsValueSearch extends DefaultFieldsValue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_field_id'], 'integer'],
            [['value'], 'safe'],
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
        $query = DefaultFieldsValue::find();

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
            'product_field_id' => $this->product_field_id,
        ]);

        $query->andFilterWhere(['like', 'value', $this->value]);

        $query->orderBy('id DESC');

        return $dataProvider;
    }
}
