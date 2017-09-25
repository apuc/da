<?php

namespace backend\modules\vk\models;

use common\classes\Debug;
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
            [['id', 'from_id', 'owner_id', 'owner_type', 'dt_add', 'from_type', 'rss'], 'integer'],
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
     * @param array $condition
     * @param string $orderBy
     * @return ActiveDataProvider
     */
    public function search($params, $condition = null, $orderBy)
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

        if($condition){
            foreach ($condition as $key => $cond){
                if(is_array($cond)){
                    $query->andWhere($cond);
                }else
                    $query->andWhere([$key => $cond]);
            }
        }

        //$query->andWhere($condition);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'from_id' => $this->from_id,
            'owner_id' => $this->owner_id,
            'owner_type' => $this->owner_type,
            'dt_add' => $this->dt_add,
            'from_type' => $this->from_type,
            'rss' => $this->rss,
        ]);

        $query->andFilterWhere(['like', 'vk_id', $this->vk_id])
            ->andFilterWhere(['like', 'post_type', $this->post_type])
            ->andFilterWhere(['like', 'text', $this->text]);

        $query->orderBy($orderBy.' DESC');

        return $dataProvider;
    }
}
