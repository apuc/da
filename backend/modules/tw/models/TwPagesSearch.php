<?php

namespace backend\modules\tw\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\tw\models\TwPages;

/**
 * TwPagesSearch represents the model behind the search form of `backend\modules\tw\models\TwPages`.
 */
class TwPagesSearch extends TwPages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tw_id', 'status'], 'integer'],
            [['title', 'screen_name', 'icon'], 'safe'],
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
        $query = TwPages::find();

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
            'tw_id' => $this->tw_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'screen_name', $this->screen_name])
            ->andFilterWhere(['like', 'icon', $this->icon]);

        return $dataProvider;
    }
}
