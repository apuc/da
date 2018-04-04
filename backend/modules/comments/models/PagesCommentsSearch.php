<?php

namespace backend\modules\comments\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\db\PagesComments;

/**
 * PagesCommentsSearch represents the model behind the search form of `common\models\db\PagesComments`.
 */
class PagesCommentsSearch extends PagesComments
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pages_id', 'user_id', 'dt_add', 'parent_id', 'moder_checked', 'published', 'verified'], 'integer'],
            [['content'], 'safe'],
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
        $query = PagesComments::find();

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
            'pages_id' => $this->pages_id,
            'user_id' => $this->user_id,
            'dt_add' => $this->dt_add,
            'parent_id' => $this->parent_id,
            'moder_checked' => $this->moder_checked,
            'published' => $this->published,
            'verified' => $this->verified,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content]);

        $query->orderBy(['dt_add' => SORT_DESC]);

        return $dataProvider;
    }
}
