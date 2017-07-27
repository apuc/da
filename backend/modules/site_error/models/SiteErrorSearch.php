<?php

namespace backend\modules\site_error\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\site_error\models\SiteError;

/**
 * SiteErrorSearch represents the model behind the search form about `backend\modules\site_error\models\SiteError`.
 */
class SiteErrorSearch extends SiteError
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'dt_add'], 'integer'],
            [['url', 'msg'], 'safe'],
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
        $query = SiteError::find();

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
            'user_id' => $this->user_id,
            'dt_add' => $this->dt_add,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'msg', $this->msg]);

        return $dataProvider;
    }
}
