<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 02.03.18
 * Time: 10:54
 */

namespace common\classes;

use frontend\modules\company\models\Company;
use frontend\modules\shop\models\Products;

class Cart
{
    public static function getCart()
    {
        $cart = \Yii::$app->cart->getCart();
        $data = [];
        if(!empty($cart)){
            $companies = Company::find()->where(['id' => array_keys($cart)])->indexBy('id')->asArray()->all();
            foreach ($cart as $company_id=>$items){
                $data[$company_id] = $companies[$company_id];
                $products = Products::find()->where(['id' => array_keys($items)])->indexBy('id')->asArray()->all();
                foreach ($items as $product_id=>$count) {
                    $data[$company_id]['products'][$product_id] = $products[$product_id] + ['count' => $count];
                }
            }
        }

        return $data;
    }
}