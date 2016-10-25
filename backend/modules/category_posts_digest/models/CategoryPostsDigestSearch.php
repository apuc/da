<?php

namespace backend\modules\category_posts_digest\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\category_posts_digest\models\CategoryPostsDigest;

/**
 * CategoryPostsDigestSearch represents the model behind the search form about `backend\modules\category_posts_digest\models\CategoryPostsDigest`.
 */
class CategoryPostsDigestSearch extends CategoryPostsDigest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'dt_add', 'dt_update'], 'integer'],
            [['title', 'slug', 'icon', 'type'], 'safe'],
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
        $query = CategoryPostsDigest::find();

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
            'parent_id' => $this->parent_id,
            'dt_add' => $this->dt_add,
            'dt_update' => $this->dt_update,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
