<?php

namespace backend\modules\banned_ip\models;

use yii\data\ActiveDataProvider;

class BannedIpSearch extends BannedIp
{
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = self::find()->orderBy('id DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ip_mask' => $this->ip_mask,
        ]);

        return $dataProvider;
    }
}