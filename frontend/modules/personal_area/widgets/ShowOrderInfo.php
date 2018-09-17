<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 30.03.18
 * Time: 9:38
 */

namespace frontend\modules\personal_area\widgets;

use common\classes\Debug;
use common\models\db\OrderProduct;
use frontend\modules\shop\models\Products;
use yii\base\Widget;

class ShowOrderInfo extends Widget
{
    public function run()
    {
        $productsUser = Products::find()
            ->where(['user_id' => \Yii::$app->user->id])
            ->count();
        if($productsUser == 0){
            return false;
        }

        $orderCount = OrderProduct::find()
            ->select(['order_id'])
            ->joinWith(['company', 'order'])
            ->where(['`company`.`user_id`' => \Yii::$app->user->id])
            ->andWhere(['`order`.`status`' => 0])
            ->distinct()
            ->count();

        //Debug::prn($orderCount);

        return $this->render('order-info', ['orderInfo' => $orderCount]);
    }
}