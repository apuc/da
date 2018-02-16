<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 01.02.18
 * Time: 13:49
 */

namespace frontend\modules\shop\controllers;

use common\classes\Debug;
use frontend\modules\shop\models\CategoryShop;
use frontend\modules\shop\models\Products;
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
        return $this->render('view', ['model' => $model]);
    }
}
