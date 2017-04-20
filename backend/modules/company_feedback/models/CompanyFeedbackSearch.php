<?php

namespace backend\modules\company_feedback\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\company_feedback\models\CompanyFeedback;

/**
 * CompanyFeedbackSearch represents the model behind the search form about `backend\modules\company_feedback\models\CompanyFeedback`.
 */
class CompanyFeedbackSearch extends CompanyFeedback
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'dt_add', 'dt_update', 'company_id'], 'integer'],
            [['company_name', 'feedback'], 'safe'],
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
        $query = CompanyFeedback::find();

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
            'dt_update' => $this->dt_update,
        ]);

        $query->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'feedback', $this->feedback]);

        return $dataProvider;
    }
}
