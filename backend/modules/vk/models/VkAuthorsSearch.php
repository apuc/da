<?php

namespace backend\modules\vk\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\vk\models\VkAuthors;

/**
 * VkAuthorsSearch represents the model behind the search form about `backend\modules\vk\models\VkAuthors`.
 */
class VkAuthorsSearch extends VkAuthors
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vk_id', 'sex', 'user_id'], 'integer'],
            [['first_name', 'last_name', 'screen_name', 'photo'], 'safe'],
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
        $query = VkAuthors::find();

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
            'vk_id' => $this->vk_id,
            'sex' => $this->sex,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'screen_name', $this->screen_name])
            ->andFilterWhere(['like', 'photo', $this->photo]);

        return $dataProvider;
    }
}
