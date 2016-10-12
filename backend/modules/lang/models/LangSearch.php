<?php

namespace backend\modules\lang\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\lang\models\Lang;

/**
 * LangSearch represents the model behind the search form about `backend\modules\lang\models\Lang`.
 */
class LangSearch extends Lang
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'default', 'date_update', 'date_create'], 'integer'],
            [['url', 'local', 'name'], 'safe'],
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
        $query = Lang::find();

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
            'default' => $this->default,
            'date_update' => $this->date_update,
            'date_create' => $this->date_create,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'local', $this->local])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
