<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 02.03.18
 * Time: 15:24
 */

namespace frontend\modules\shop\controllers;

use common\classes\Cart;
use common\classes\DaMail;
use common\classes\Debug;
use common\classes\UserFunction;
use common\models\db\Order;
use common\models\db\OrderProduct;
use frontend\controllers\MainWebController;
use frontend\modules\shop\models\Products;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class CartController extends MainWebController
{
    public $layout = 'shop';

    function init()
    {
        parent::init();
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'add-in-cart' => ['post'],
                    'set-count' => ['post'],
                    'delete-from-cart' => ['post'],
                ],
            ],
        ]);
    }

    public function actionAddInCart()
    {

        $postData = Yii::$app->request->post();
        //$postData['product_id'] = 27;
        /* $postData['shop_id'] = 20;
         $postData['count'] = 1;*/
        //Debug::dd($postData['product_id']);
        //$htmlCart = '';
        $cart = Cart::getProductsWithBuy($postData['product_id']);
        //Debug::dd($cart);
        $htmlCart = $this->renderPartial('modal-cart', ['model' => $cart]);
        return json_encode([
            'success' => Yii::$app->cart->add($postData['shop_id'], $postData['product_id'], $postData['count']),
            'cartCount' => Yii::$app->cart->count,
            'cart' => $htmlCart,
        ]);
    }

    public function actionSetCount()
    {
        $postData = Yii::$app->request->post();

        Yii::$app->cart->update($postData['shop_id'], $postData['product_id'], $postData['count']);
        $cart = Cart::getCart();

        return $this->renderAjax('cart-ajax', ['cart' => $cart]);
        /*return json_encode([
            'success' => Yii::$app->cart->setCount($postData['product_id'], $postData['count']),
            'cartStatus' => Yii::$app->cart->status
        ]);*/
    }

    public function actionDeleteFromCart()
    {
        $postData = Yii::$app->request->post();
        Yii::$app->cart->delete($postData['shop_id'], $postData['product_id']);
        /*return json_encode([
            'success' => Yii::$app->cart->delete($postData['shop_id'], $postData['product_id']),
            'cartStatus' => Cart::getCart()
        ]);*/
        return $this->redirect('cart');
    }

    public function actionPriceCount()
    {
        $postData = Yii::$app->request->post();
        $products = Products::find()->where(['id' => $postData['product_id']])->one();
        $html = '';
        if (!empty($products->new_price)) {
            $html .= $products->new_price * $postData['count'];
        } else {
            $html .= $products->price * $postData['count'];
        }
        return number_format($html, 0, '.', ' ') . 'руб. / ' . $postData['count'] . ' шт.';
    }

    public function actionClear()
    {
        Yii::$app->cart->clear();

        return $this->redirect(['cart']);
    }

    public function actionCart()
    {
        $cart = Cart::getCart();
        if ($cart) {
            return $this->render('cart', ['cart' => $cart]);
        } else {
            return $this->render('not-cart');
        }

    }

    public function actionOrderOneShop($shopId)
    {
        $model = new Order();
        if ($model->load(Yii::$app->request->post())) {
            $model->shop_id = $shopId;
            $model->dt_add = time();
            $model->save();
            $cart = \Yii::$app->cart->getCart();
            //Debug::dd($cart);
            foreach ($cart[$shopId] as $product => $count) {
                $orderProducts = new OrderProduct();

                $orderProducts->shop_id = $shopId;
                $orderProducts->order_id = $model->id;
                $orderProducts->product_id = $product;
                $orderProducts->count = $count;

                $orderProducts->save();

                \Yii::$app->cart->delete($shopId, $product);
            }
            DaMail::createMsg()->setSubject('Новый заказ')
                ->setTo(UserFunction::getUserByShopId($shopId)->email)
                ->setFrom(['noreply@da-info.pro' => 'DA-Info'])
                ->setTpl('layouts/html')
                ->setContent('<div>Вы получили новый заказ</div>')
                ->send();

            DaMail::createMsg()->setSubject('Заказ ожидает обработки')
                ->setTo($model->email)
                ->setFrom(['noreply@da-info.pro' => 'DA-Info'])
                ->setTpl('layouts/html')
                ->setContent('<div>Ваш заказ ожидает обработки</div>')
                ->send();
            return $this->redirect(['cart']);
        }
        $cart = Cart::getCartOneShop($shopId);
        return $this->render('form-order', [
            'model' => $model,
            'cart' => $cart,
        ]);
    }

    public function actionOrderShop()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            /*Debug::dd($model);*/

            $cart = \Yii::$app->cart->getCart();
            foreach ($cart as $shop => $products) {
                foreach ($products as $product => $count) {
                    $orderProducts = new OrderProduct();

                    $orderProducts->shop_id = $shop;
                    $orderProducts->order_id = $model->id;
                    $orderProducts->product_id = $product;
                    $orderProducts->count = $count;

                    $orderProducts->save();
                }

            }
            $summCart = Cart::getSummCart();
            Yii::$app->cart->clear();
            $order = Order::find()->where(['id' => $model->id])->one();

            return $this->render('thanks-order', ['order' => $order, 'summCart' => $summCart]);
        }
        $cart = Cart::getCart();
        return $this->render('form-order', [
            'model' => $model,
            'cart' => $cart,
        ]);
    }
}