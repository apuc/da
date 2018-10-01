<?php

namespace backend\modules\instagram\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\instagram\models\InstPhoto;

/**
 * InstPhotosSearch represents the model behind the search form of `backend\modules\instagram\models\InstPhoto`.
 */
class InstPhotosSearch extends InstPhoto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['photo_url', 'author_name', 'author_img', 'dt_add','dt_publish', 'caption', 'meta_title', 'meta_description'], 'safe'],
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
        $query = InstPhoto::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query->where("status=0"),
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
        ]);

        $query->andFilterWhere(['like', 'photo_url', $this->photo_url])
            ->andFilterWhere(['like', 'author_name', $this->author_name])
            ->andFilterWhere(['like', 'author_img', $this->author_img])
            ->andFilterWhere(['like', 'dt_add', $this->dt_add])
            ->andFilterWhere(['like', 'dt_publish', $this->dt_publish])
            ->andFilterWhere(['like', 'caption', $this->caption])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description]);

        return $dataProvider;
    }
}
