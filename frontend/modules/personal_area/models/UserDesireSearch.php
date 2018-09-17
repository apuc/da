<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 03.03.2018
 * Time: 19:25
 */

namespace frontend\modules\personal_area\models;

use common\models\db\LikeProducts;
use yii\data\ActiveDataProvider;

class UserDesireSearch extends LikeProducts
{
    public function search($params)
    {
        $query = LikeProducts::find();

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
        $query->with('product');
        $query->orderBy('dt_add DESC');
        return $dataProvider;
    }
}