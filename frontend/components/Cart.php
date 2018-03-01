<?php
namespace frontend\components;

use common\classes\Debug;
use frontend\models\sitemap\Company;
use frontend\modules\shop\models\Products;
use yii\base\Component;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class Cart
 * @package frontend\components
 * @property Order $order
 * @property string $status
 */
class Cart extends Component
{
    const SESSION_KEY = 'shop_cart';

    public function add($shop_id, $product_id, $count=1)
    {
        $cart = $this->getCart();
        if (isset($cart[$shop_id][$product_id])) {
            $count = $cart[$shop_id][$product_id] + $count;
        }

        $this->update($shop_id, $product_id, $count);
    }

    public function update($shop_id, $product_id, $count=1)
    {
        $cart = $this->getCart();
        $cart[$shop_id][$product_id] = $count;
        $this->setCart($cart);
    }

    public function delete($shop_id, $product_id)
    {
        $cart = $this->getCart();
        if (isset($cart[$shop_id][$product_id]))
            unset($cart[$shop_id][$product_id]);

        $this->setCart($cart);
    }

    public function clear()
    {
        Yii::$app->session->remove(self::SESSION_KEY);
    }

    public function isEmpty()
    {
        return !!$this->getCount();
    }

    public function getCount()
    {
        $count = 0;
        $cart = $this->getCart();
        foreach ($cart as $products)
            $count += count($products);

        return $count;
    }

    public function getCart()
    {
        $cart = Yii::$app->session->get(self::SESSION_KEY);

        return $cart ? json_decode($cart, true) : [];
    }

    public function setCart($cart=null)
    {
        if (is_array($cart) && !empty($cart))
            Yii::$app->session->set(self::SESSION_KEY, json_encode($cart));
        else $this->clear();
    }

    public function getCartData()
    {
        $cart = $this->getCart();
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
