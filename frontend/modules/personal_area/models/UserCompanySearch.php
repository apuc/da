<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 03.07.2017
 * Time: 15:53
 */

namespace frontend\modules\personal_area\models;

use common\classes\Debug;
use frontend\modules\company\models\Company;
use yii\data\ActiveDataProvider;

class UserCompanySearch extends Company
{
    public function search($params)
    {
        $query = Company::find();

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
            'status' => [1,0,2]
        ]);

        $query->orderBy('dt_update DESC');


        $query->with('tariff');
        return $dataProvider;
    }
}