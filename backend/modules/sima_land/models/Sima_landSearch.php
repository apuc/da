<?php

namespace backend\modules\sima_land\models;

use yii\data\ActiveDataProvider;

class Sima_landSearch extends Sima_land
{
    public function search()
    {
        $query = Sima_land::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }
}