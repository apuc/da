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
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class ShopController extends Controller
{

    public $layout = 'shop';

    public function actionIndex()
    {
        Debug::prn('Вывод списка всех товаров');
    }

    public function actionCategory($category)
    {
        $model = new CategoryShop();
        $categoryModel = $model->getCategoryInfoBySlug($category);

        $modelProduct = new Products();
        $prducts = $modelProduct->listProduct($categoryModel->id);

        $categoryList = \common\classes\Shop::getListCategoryAllInfo($categoryModel->id, []);

        //$cat = $model->getEndCategory($category);
        //Debug::dd($cat);

        //Debug::prn( $category);
        //
        if ($model->getEndCategory($category)) {
            $category = CategoryShop::find()->all();
            $categoryTreeArr = $categoryModel->getArrayTreeCategory($category);
//Debug::dd(ArrayHelper::index($category, 'id'));
            return $this->render('category',
                [
                    'categoryInfo' => $categoryModel,
                    'categoryTreeArr' => $categoryTreeArr,
                    'ollCategory' => ArrayHelper::index($category, 'id'),
                    'products' => $prducts,
                    'categoryList' => $categoryList,
                ]);
        }

        return $this->render('list-products');

    }

    public function actionShow($slug)
    {
        $this->layout = 'single-shop';
        $model = Products::find()
            ->where(['slug' => $slug])
            ->with('productFieldsValues.field', 'company', 'images', 'category', 'reviews')
            ->one();

        $currentUserId = Yii::$app->user->id;
        if (!empty($currentUserId)) {
            $thisUserLike = LikeProducts::find()
                ->where(['product_id' => $model->id, 'user_id' => $currentUserId])->one();
            if (!empty($thisUserLike)) {
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
        if (!$userId) {
            return true;
        }

        $postData = Yii::$app->request->post();

        $like = LikeProducts::find()->where(['product_id' => $postData['product_id'], 'user_id' => $userId])->one();

        if (empty($like)) {
            $like = new LikeProducts();
            $like->product_id = $postData['product_id'];
            $like->user_id = $userId;
            $like->dt_add = time();

            $like->save();
            return true;
        } else {
            LikeProducts::deleteAll(['product_id' => $postData['product_id'], 'user_id' => $userId]);
            return false;
        }
    }
}
