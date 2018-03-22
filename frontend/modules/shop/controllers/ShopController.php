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
use common\classes\Shop;
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

    /**
     * Вывод страницы все категории магазина
     */
    public function actionIndex()
    {
        //Debug::prn('Вывод списка всех товаров');
        $category = Shop::getAllCategory();

        $modelProduct = new Products();
        $products = $modelProduct->listProduct(12);

        //Debug::dd($category);
        return $this->render('all-category',
            [
                'category' => $category,
                'products' => $products,
            ]
        );
    }

    /**
     * вывод старницы промежуточной категории со списком товаров всех категорий
     * входящих в текущую или вывод списка товаров последней категории с фильтром
     * по этим товарам
     *
     * @param $category
     * @return string
     */
    public function actionCategory($category)
    {
        //Debug::dd($category);
        $model = new CategoryShop();
        $categoryModel = $model->getCategoryInfoBySlug($category);



        $modelProduct = new Products();
        $products = $modelProduct->listProduct(16, $categoryModel->id);

        $categoryList = \common\classes\Shop::getListCategoryAllInfo($categoryModel->id, []);
        //Debug::dd( $categoryList);
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
                    'products' => $products,
                    'categoryList' => $categoryList,
                ]);
        }

        return $this->render('list-products');

    }

    /**
     * Вывод страницы карточки товара
     * @param $slug
     * @return string
     */
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

        $categoryList = \common\classes\Shop::getListCategoryAllInfo($model->category_id, []);
        return $this->render('view',
            [
                'model' => $model,
                'like' => $thisUserLike,
                'categoryList' => $categoryList,
            ]
        );
    }

    /**
     * Добавить в мои желания товар
     * @return bool
     */
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
