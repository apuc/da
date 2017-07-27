<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 20.07.2017
 * Time: 12:38
 */

namespace frontend\modules\personal_area\models;

use common\models\db\Poster;
use yii\data\ActiveDataProvider;

class UserPosterSearch extends Poster
{
    public function search($params)
    {
        $query = Poster::find();

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

        $query->andWhere(['!=', 'status', 2]);
        $query->orderBy('dt_update DESC');


        return $dataProvider;
    }
}