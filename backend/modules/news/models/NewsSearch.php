<?php

namespace backend\modules\news\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\news\models\News;

/**
 * NewsSearch represents the model behind the search form about `backend\modules\news\models\News`.
 */
class NewsSearch extends News
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dt_add', 'dt_update', 'user_id', 'lang_id', 'rss'], 'integer'],
            [['title', 'content', 'slug', 'tags', 'photo', 'meta_title', 'meta_descr', 'views', 'status'], 'safe'],
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
        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        $query = News::find();

        if(isset($role['Редактор новостей']))
        {
            $query->andWhere(['user_id' => Yii::$app->user->id]);
        }

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
            'status' => $this->status,
            'user_id' => $this->user_id,
            'lang_id' => $this->lang_id,
            'rss' => $this->rss,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'meta_title', $this->tags])
            ->andFilterWhere(['like', 'meta_descr', $this->tags])
            ->andFilterWhere(['like', 'photo', $this->photo]);

        $query->orderBy('dt_add DESC');

        return $dataProvider;
    }
}
