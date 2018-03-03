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
use common\models\db\LikeProducts;
use frontend\modules\shop\models\CategoryShop;
use frontend\modules\shop\models\Products;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ShopController extends Controller
{

    public $layout = 'single-shop';

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

        $currentUserId  = Yii::$app->user->id;
        if (!empty($currentUserId)) {
            $thisUserLike = LikeProducts::find()
                ->where(['product_id' => $model->id, 'user_id' => $currentUserId])->one();
            if(!empty($thisUserLike)){
                $thisUserLike = true;
            }

        } else {
            $thisUserLike = false;
        }

        $model->updateAllCounters(['view' => 1], ['id' => $model->id]);

        return $this->render('view', ['model' => $model, 'like' => $thisUserLike]);
    }

    public function actionLike()
    {
        $userId = Yii::$app->user->id;
        if(!$userId) {
            return true;
        }

        $postData = Yii::$app->request->post();

        $like = LikeProducts::find()->where(['product_id' => $postData['product_id'], 'user_id' => $userId])->one();

        if(empty($like)) {
            $like = new LikeProducts();
            $like->product_id = $postData['product_id'];
            $like->user_id = $userId;

            $like->save();
            return true;
        }else{
            LikeProducts::deleteAll(['product_id' => $postData['product_id'], 'user_id' => $userId]);
            return false;
        }

        return true;
    }
}
