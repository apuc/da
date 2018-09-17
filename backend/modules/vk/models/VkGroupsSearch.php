<?php

namespace backend\modules\vk\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\vk\models\VkGroups;

/**
 * VkGroupsSearch represents the model behind the search form about `backend\modules\vk\models\VkGroups`.
 */
class VkGroupsSearch extends VkGroups
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['domain', 'vk_id'], 'safe'],
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
        $query = VkGroups::find();

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
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'domain', $this->domain])
            ->andFilterWhere(['like', 'vk_id', $this->vk_id]);

        return $dataProvider;
    }
}
