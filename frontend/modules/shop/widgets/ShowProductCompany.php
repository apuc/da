<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 16.02.18
 * Time: 16:06
 */

namespace frontend\modules\shop\widgets;

use frontend\modules\shop\models\Products;
use yii\base\Widget;

class ShowProductCompany extends Widget
{
    public $productId;
    public $companyId;

    public function run()
    {
        $model = Products::find()
            ->where(['company_id' => $this->companyId, 'status' => 1, 'type' => Products::TYPE_PRODUCT])
            ->andWhere(['!=', 'id', $this->productId])
            ->with('images')
            ->limit(5)
            ->orderBy('dt_update DESC')
            ->all();

        return $this->render('product-company', ['model' => $model]);
    }
}