<?php

namespace backend\modules\tw\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\tw\models\TwPosts;

/**
 * TwPostsSearch represents the model behind the search form of `backend\modules\tw\models\TwPosts`.
 */
class TwPostsSearch extends TwPosts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'page_id', 'dt_add', 'dt_publish', 'status'], 'integer'],
            [['title', 'meta_descr', 'tw_id', 'content', 'media_url', 'link', 'page_title', 'page_icon', 'slug'], 'safe'],
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
        $query = TwPosts::find();

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
            'page_id' => $this->page_id,
            'dt_add' => $this->dt_add,
            'dt_publish' => $this->dt_publish,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'meta_descr', $this->meta_descr])
            ->andFilterWhere(['like', 'tw_id', $this->tw_id])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'media_url', $this->media_url])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'page_title', $this->page_title])
            ->andFilterWhere(['like', 'page_icon', $this->page_icon])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        $query->orderBy('id DESC');

        return $dataProvider;
    }
}
