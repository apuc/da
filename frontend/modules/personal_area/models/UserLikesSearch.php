<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 03.07.2017
 * Time: 17:05
 */

namespace frontend\modules\personal_area\models;

use common\models\db\Likes;
use yii\data\ActiveDataProvider;

class UserLikesSearch extends Likes
{
    public function search($params)
    {
        $query = Likes::find();

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
        $query->orderBy('dt_add DESC');
        return $dataProvider;
    }
}