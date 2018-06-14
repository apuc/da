<?php

namespace backend\modules\service\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\db\ServicePeriods;

/**
 * ServicePeriodsSearch represents the model behind the search form of `common\models\db\ServicePeriods`.
 */
class ServicePeriodsSearch extends ServicePeriods
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_id'], 'integer'],
            [['start', 'end', 'week_days'], 'safe'],
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
        $query = ServicePeriods::find();

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
            'product_id' => $this->product_id,
        ]);

        $query->andFilterWhere(['like', 'start', $this->start])
            ->andFilterWhere(['like', 'end', $this->end])
            ->andFilterWhere(['like', 'week_days', $this->week_days]);

        return $dataProvider;
    }
}
