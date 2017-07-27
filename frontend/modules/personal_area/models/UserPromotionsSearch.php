<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 24.07.2017
 * Time: 14:21
 */

namespace frontend\modules\personal_area\models;

use frontend\modules\promotions\models\Stock;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class UserPromotionsSearch extends Stock
{
    public function search($params)
    {
        $query = Stock::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
                'pageSizeParam' => false,
            ],
        ]);

        $this->load($params);

        $query->andWhere([
            'user_id' => $params['user_id'],
        ]);

        $query->orderBy('dt_update DESC');

        return $dataProvider;
    }
}