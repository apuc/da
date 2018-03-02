<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 01.02.18
 * Time: 13:49
 */

namespace frontend\modules\shop\controllers;

use common\classes\Cart;
use common\classes\Debug;
use frontend\modules\shop\models\CategoryShop;
use frontend\modules\shop\models\Products;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ShopController extends Controller
{

    public $layout = 'single-shop';

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
        return json_encode([
            'success' => Yii::$app->cart->delete($postData['product_id']),
            'cartStatus' => Yii::$app->cart->status
        ]);
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

    public function actionCart()
    {
        $cart = Cart::getCart();

        return $this->render('cart', ['cart' => $cart]);
    }

    public function actionIndex()
    {
        Debug::prn('Вывод списка всех товаров');
    }

    public function actionCategory($category)
    {
        $model = new CategoryShop();
        $category = $model->getCategoryInfoBySlug($category);
        Debug::prn( $category);
        //
    }

    public function actionShow($slug)
    {
        $model = Products::find()
            ->where(['slug' => $slug])
            ->with('productFieldsValues.field', 'company', 'images', 'category')
            ->one();

        $model->updateAllCounters(['view' => 1], ['id' => $model->id]);

        return $this->render('view', ['model' => $model]);
    }
}
