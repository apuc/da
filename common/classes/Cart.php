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
                $products = Products::find()
                    ->where(['id' => array_keys($items)])
                    ->indexBy('id')
                    ->asArray()
                    ->with('images')
                    ->all();
                foreach ($items as $product_id=>$count) {
                    $data[$company_id]['products'][$product_id] = $products[$product_id] + ['count' => $count];
                }
            }
        }

        return $data;
    }

    public static function getSummShop($shopId)
    {
        $cart = self::getCart();
        $price = 0;
        foreach ($cart[$shopId]['products'] as $item){
            if(empty($item['new_price'])){
                $price += $item['price'] * $item['count'];
            }else{
                $price += $item['new_price'] * $item['count'];
            }
        }
        return $price;
    }

    public static function getSummCart()
    {
        $cart = self::getCart();
        $price = 0;
        foreach ($cart as $item){
            foreach ($item['products'] as $value){
                if(empty($value['new_price'])){
                    $price += $value['price'] * $value['count'];
                }else{
                    $price += $value['new_price'] * $value['count'];
                }
            }

        }
        return number_format($price, 0, '.', ' ');
    }
}