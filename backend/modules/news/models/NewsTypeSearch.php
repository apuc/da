<?php

namespace backend\modules\news\models;

use yii\data\ActiveDataProvider;

class NewsTypeSearch extends NewsType
{
    public function search($params)
    {
        $query = NewsType::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id])
            ->andFilterWhere(['like', 'label', $this->label])
            ->orderBy('id DESC');

        return $dataProvider;
    }
}