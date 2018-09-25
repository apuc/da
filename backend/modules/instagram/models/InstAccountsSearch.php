<?php

namespace backend\modules\instagram\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\instagram\models\InstAccounts;

/**
 * InstAccountsSearch represents the model behind the search form of `backend\modules\instagram\models\InstAccounts`.
 */
class InstAccountsSearch extends InstAccounts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'account_id'], 'integer'],
            [['username', 'profile_img', 'iprofile_link'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = InstAccounts::find();

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
            'account_id' => $this->account_id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'profile_img', $this->profile_img])
            ->andFilterWhere(['like', 'iprofile_link', $this->iprofile_link]);

        return $dataProvider;
    }
}
