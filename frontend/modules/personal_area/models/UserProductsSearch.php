<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 21.02.18
 * Time: 9:12
 */

namespace frontend\modules\personal_area\models;

use frontend\modules\shop\models\Products;
use yii\data\ActiveDataProvider;

class UserProductsSearch extends Products
{
    public function search($params)
    {
        $query = Products::find()->where(['type' => Products::TYPE_PRODUCT]);

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
        $query->andWhere(['in', 'status', [0, 1]]);
        $query->with('company', 'images');
        $query->orderBy('dt_update DESC');

        return $dataProvider;
    }
}