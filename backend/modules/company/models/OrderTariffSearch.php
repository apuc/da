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
    public function search($params)
    {
        $query = CompanyTariffOrder::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
                'pageSizeParam' => false,
            ],
        ]);
        $this->load($params);

        $query->andFilterWhere([
            'tariff_id' => $this->tariff_id,
        ]);

        $query->andFilterWhere([
            'company_id' => $this->company_id,
        ]);

        $query->with('tariff');
        return $dataProvider;
    }
}