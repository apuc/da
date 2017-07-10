<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 03.07.2017
 * Time: 16:33
 */

namespace frontend\modules\personal_area\models;

use backend\modules\news\models\News;
use yii\data\ActiveDataProvider;

class UserNewsSearch extends News
{
    public function search($params)
    {
        $query = News::find();

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