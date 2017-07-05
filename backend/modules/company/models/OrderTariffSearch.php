<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 05.07.2017
 * Time: 9:20
 */

namespace backend\modules\company\models;

use common\models\db\CompanyTariffOrder;
use yii\data\ActiveDataProvider;

class OrderTariffSearch extends CompanyTariffOrder
{
    public function search()
    {
        $query = CompanyTariffOrder::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
                'pageSizeParam' => false,
            ],
        ]);


        return $dataProvider;
    }
}