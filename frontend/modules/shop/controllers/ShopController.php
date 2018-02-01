<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 01.02.18
 * Time: 13:49
 */

namespace frontend\modules\shop\controllers;

use common\classes\Debug;
use yii\web\Controller;

class ShopController extends Controller
{
    public function actionIndex()
    {
        Debug::prn('Вывод списка всех товаров');
    }

    public function actionCategory($category)
    {
        Debug::prn('Вывод списка товаров категории'. $category);
        //
    }

    public function actionShow($slug)
    {
        Debug::prn('Отображение страницы товара');
        // Отображение страницы товара
    }
}
