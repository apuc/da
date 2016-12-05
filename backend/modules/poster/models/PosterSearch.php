<?php

namespace backend\modules\poster\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\poster\models\Poster;

/**
 * PosterSearch represents the model behind the search form about `backend\modules\poster\models\Poster`.
 */
class PosterSearch extends Poster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dt_add', 'dt_update','dt_event', 'views', 'status'], 'integer'],
            [['title', 'slug', 'descr', 'short_descr', 'price', 'start', 'meta_title', 'meta_descr'], 'safe'],
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
        $query = Poster::find();

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
            'dt_add' => $this->dt_add,
            'dt_update' => $this->dt_update,
            'dt_event' => $this->dt_update,
            'views' => $this->views,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'descr', $this->descr])
            ->andFilterWhere(['like', 'short_descr', $this->short_descr])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'start', $this->start])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'meta_descr', $this->meta_descr]);

        $query->orderBy('dt_add DESC');

        return $dataProvider;
    }
}
