<?php

namespace backend\modules\company_views\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\db\CompanyViews;

/**
 * CompanyViewsSearch represents the model behind the search form about `common\models\db\CompanyViews`.
 */
class CompanyViewsSearch extends CompanyViews
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'company_id', 'count'], 'integer'],
            [['date'], 'safe'],
            [['ip_address'], 'string'],
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
        $query = CompanyViews::find();

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
            'company_id' => $this->company_id,
            'date' => $this->date,
            'ip_address' => $this->ip_address ? ip2long($this->ip_address) : '',
            'count' => $this->count,
        ]);
        return $dataProvider;
    }
}
