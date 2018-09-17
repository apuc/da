<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 04.07.2017
 * Time: 13:31
 */

namespace frontend\modules\personal_area\models;

use common\models\db\Comments;
use yii\data\ActiveDataProvider;

class UserCommentsSearch extends Comments
{
    public function search($params)
    {
        $query = Comments::find();

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