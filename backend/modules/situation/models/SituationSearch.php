<?php

namespace backend\modules\situation\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\situation\models\Situation;

/**
 * SituationSearch represents the model behind the search form about `backend\modules\situation\models\Situation`.
 */
class SituationSearch extends Situation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'situation_status_id'], 'integer'],
            [['name', 'report_time', 'descr'], 'safe'],
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
        $query = Situation::find();

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
            'situation_status_id' => $this->situation_status_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'report_time', $this->report_time])
            ->andFilterWhere(['like', 'descr', $this->descr]);

        return $dataProvider;
    }
}
