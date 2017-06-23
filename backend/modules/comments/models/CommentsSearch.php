<?php

namespace backend\modules\comments\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\comments\models\Comments;

/**
 * CommentsSearch represents the model behind the search form about `backend\modules\comments\models\Comments`.
 */
class CommentsSearch extends Comments
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'post_id', 'user_id', 'dt_add', 'parent_id', 'moder_checked', 'published'], 'integer'],
            [['post_type', 'content'], 'safe'],
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
        $query = Comments::find();

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
            'post_id' => $this->post_id,
            'user_id' => $this->user_id,
            'dt_add' => $this->dt_add,
            'parent_id' => $this->parent_id,
            'moder_checked' => $this->moder_checked,
            'published' => $this->published,
        ]);

        $query->andFilterWhere(['like', 'post_type', $this->post_type])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
