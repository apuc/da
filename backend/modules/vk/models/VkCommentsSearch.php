<?php

namespace backend\modules\vk\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\vk\models\VkComments;

/**
 * VkCommentsSearch represents the model behind the search form about `backend\modules\vk\models\VkComments`.
 */
class VkCommentsSearch extends VkComments
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'from_id', 'owner_id', 'post_id', 'dt_add'], 'integer'],
            [['vk_id', 'text'], 'safe'],
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
        $query = VkComments::find();

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
            'post_id' => $this->post_id,
            'dt_add' => $this->dt_add,
        ]);

        $query->andFilterWhere(['like', 'vk_id', $this->vk_id])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
