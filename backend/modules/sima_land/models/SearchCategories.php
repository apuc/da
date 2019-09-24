<?php

namespace backend\modules\sima_land\models;

use yii\data\ActiveDataProvider;

class SearchCategories
{
    public function search($queryParams)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $queryParams,
        ]);

        return $dataProvider;
    }
}
