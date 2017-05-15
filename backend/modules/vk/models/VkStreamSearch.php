<?php

namespace backend\modules\vk\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\vk\models\VkStream;

/**
 * VkStreamSearch represents the model behind the search form about `backend\modules\vk\models\VkStream`.
 */
class VkStreamSearch extends VkStream
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'from_id', 'owner_id', 'owner_type', 'dt_add', 'from_type'], 'integer'],
            [['vk_id', 'post_type', 'text'], 'safe'],
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
        $query = VkStream::find();

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
            'from_id' => $this->from_id,
            'owner_id' => $this->owner_id,
            'owner_type' => $this->owner_type,
            'dt_add' => $this->dt_add,
            'from_type' => $this->from_type,
        ]);

        $query->andFilterWhere(['like', 'vk_id', $this->vk_id])
            ->andFilterWhere(['like', 'post_type', $this->post_type])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
