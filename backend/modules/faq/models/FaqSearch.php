<?php

namespace backend\modules\faq\models;

use common\classes\Debug;
use common\models\db\CategoryFaq;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\faq\models\Faq;

/**
 * FaqSearch represents the model behind the search form about `backend\modules\faq\models\Faq`.
 */
class FaqSearch extends Faq
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dt_add', 'dt_update', 'views', 'user_id', 'company_id','cat_id'], 'integer'],
            [['question', 'answer', 'slug', 'type'], 'safe'],
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
        $query = Faq::find();
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
            'views' => $this->views,
            'user_id' => $this->user_id,
            'company_id' => $this->company_id,
            'cat_id' => $this->cat_id,

        ]);
        $query->andFilterWhere(['like', 'question', $this->question])
            ->andFilterWhere(['like', 'answer', $this->answer])
            ->andFilterWhere(['like', 'type', $this->type]);

        $query->orderBy('dt_add DESC');

        return $dataProvider;
    }
}
