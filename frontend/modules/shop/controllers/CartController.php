<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 02.03.18
 * Time: 15:24
 */

namespace frontend\modules\shop\controllers;

use common\classes\Cart;
use frontend\modules\shop\models\Products;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class CartController extends Controller
{
    public $layout = 'shop';

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
        /*$postData['product_id'] = 27;
        $postData['shop_id'] = 20;
        $postData['count'] = 1;*/
        //Debug::dd($postData['product_id']);
        return json_encode([
            'success' => Yii::$app->cart->add($postData['shop_id'], $postData['product_id'], $postData['count']),
            'cartCount' => Yii::$app->cart->count
        ]);
    }

    public function actionSetCount()
    {
        $postData = Yii::$app->request->post();
        return json_encode([
            'success' => Yii::$app->cart->setCount($postData['product_id'], $postData['count']),
            'cartStatus' => Yii::$app->cart->status
        ]);
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
        if(!empty( $products->new_price )){
            $html .= $products->new_price * $postData['count'];
        }else{
            $html .= $products->price * $postData['count'];
        }
        return number_format($html, 0, '.', ' ') . 'руб. / ' . $postData['count'] .' шт.';
    }

    public function actionClear()
    {
        Yii::$app->cart->clear();

        return $this->redirect(['cart']);
    }

    public function actionCart()
    {
        $cart = Cart::getCart();
        if ($cart){
            return $this->render('cart', ['cart' => $cart]);
        }
        else{
            return $this->render('not-cart');
        }

    }


}