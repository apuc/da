<?php

namespace frontend\modules\news\models;

use common\models\db\CategoryNewsRelations;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\news\models\News;

/**
 * NewsSearch represents the model behind the search form about `frontend\modules\news\models\News`.
 */
class NewsSearch extends News
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dt_add', 'dt_update', 'status', 'user_id', 'lang_id', 'views'], 'integer'],
            [['title', 'content', 'slug', 'tags', 'photo', 'meta_title', 'meta_descr'], 'safe'],
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
        $query = News::find();

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
            'views' => $this->views,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'meta_descr', $this->meta_descr]);

        return $dataProvider;
    }

    public function getNews($useReg)
    {
        $newsQuery = News::find()
            ->from('news FORCE INDEX(`dt_public`)')
            ->where([
                'status' => 0,
                'hot_new' => 0,
            ]);
        if($useReg != -1){
            $newsQuery->andWhere("(`region_id` IS NULL OR `region_id`=$useReg)");

        }
        $newsQuery->andWhere(['in_company' => 0]);
        $news = $newsQuery
            ->limit(34)
            ->orderBy('dt_public DESC')
            ->with('category')
            ->all();

        return $news;
    }

    public function getHotNews($useReg)
    {
        $hotNewsQuery = News::find()

            ->where([
                'hot_new' => 1,
                'status' => 0,
            ]);
        if($useReg != -1){
            $hotNewsQuery->andWhere("(`region_id` IS NULL OR `region_id`=$useReg)");
        }
        $hotNews = $hotNewsQuery->limit(5)
            ->orderBy('dt_public DESC')
            ->with('category')
            ->all();

        return $hotNews;
    }

    public function getCategoryNews($useReg, $category)
    {
        $query = CategoryNewsRelations::find()
            ->where(['cat_id' => $category])
            ->joinWith('news');

        if($useReg != -1){
            $query->andWhere("(`region_id` IS NULL OR `region_id`=$useReg)");
        }
        $query->andWhere(['in_company' => 0]);
        $news = $query
            ->orderBy('`news`.`dt_public` DESC')
            ->with('cat')
            ->limit(34)
            ->all();
        return $news;
    }

    public function getCategoryHotNews($useReg, $category)
    {
        $query = CategoryNewsRelations::find()
            ->where(['cat_id' => $category])
            ->joinWith('hotNews');

        if($useReg != -1){
            $query->andWhere("(`region_id` IS NULL OR `region_id`=$useReg)");
        }
        $news = $query
            ->orderBy('`news`.`dt_public` DESC')
            ->with('cat')
            ->limit(5)
            ->all();
        return $news;
    }
}
