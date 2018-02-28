<?php
namespace frontend\components;

use common\classes\Debug;
use common\models\db\Order;
use common\models\db\OrderProduct;
use yii\base\Component;
use Yii;

/**
 * Class Cart
 * @package frontend\components
 * @property Order $order
 * @property string $status
 */
class Cart extends Component
{
    const SESSION_KEY = 'order_id';

    private $_order;


    public function add($productId, $count)
    {
       /* $this->clean();
        Debug::dd(123);*/
        $link = OrderProduct::findOne(['product_id' => $productId, 'order_id' => $this->getOrderId()]);
        if (!$link) {
            $link = new OrderProduct();
        }
        $link->product_id = $productId;
        $link->order_id = $this->order->id;
        $link->count += $count;
        return $link->save();
    }

    public function getOrder()
    {
        if ($this->_order == null) {
            $this->_order = Order::findOne(['id' => $this->getOrderId()]);
        }
        return $this->_order;
    }

    public function createOrder()
    {
        $order = new Order();
        if ($order->save()) {
            $this->_order = $order;
            return true;
        }
        return false;
    }

    private function getOrderId()
    {
        if (Yii::$app->session->has(self::SESSION_KEY)) {
            if ($this->createOrder()) {
                Yii::$app->session->set(self::SESSION_KEY, $this->_order->id);
            }
        }
        return Yii::$app->session->get(self::SESSION_KEY);
    }

    public function delete($productId)
    {
        $link = OrderProduct::findOne(['product_id' => $productId, 'order_id' => $this->getOrderId()]);
        if (!$link) {
            return false;
        }
        return $link->delete();
    }

    public function setCount($productId, $count)
    {//Debug::dd($this->getOrderId());
        $link = OrderProduct::findOne(['product_id' => $productId, 'order_id' => $this->getOrderId()]);
        if (!$link) {
            return false;
        }
        $link->count = $count;
        return $link->save();
    }

    public function getStatus()
    {
        if (!$this->isEmpty()) {
            return Yii::t('app', 'В корзине пусто');
        }
        /*return Yii::t('app',
            //'В корзине {productsCount, number} {productsCount, plural, one{товар} few{товара} many{товаров} other{товара}} на сумму {amount} руб.',
            'В корзине {productsCount, number}',
            [
                'productsCount' => $this->order->productsCount($this->order->id),
                //'amount' => $this->order->amount
            ]);*/
        return [
            'productsCount' => $this->order->productsCount($this->order->id),
            //'amount' => $this->order->amount
            ];
    }

    public function getCountProductsCart()
    {
//Debug::dd($this->isEmpty());
        if (!$this->isEmpty()) {
            return 0;
        }
        return $this->order->productsCount;
    }

    public function isEmpty()
    {
        if (!Yii::$app->session->has(self::SESSION_KEY)) {
            return true;
        }
        /*if( empty($this->order) ) {
            return false;
        }*/
        return $this->order->productsCount ? false : true;
    }

    public function clean()
    {
        Yii::$app->session->remove(self::SESSION_KEY);
    }

   /* public function productsCount()
    {
        return OrderProduct::find()->where(['order_id' => $this->order->id])->count();
    }*/
}
