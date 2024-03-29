<?php

namespace frontend\modules\shop\controllers;

use common\classes\Debug;
use common\models\db\KeyValue;
use common\models\db\ProductMark;
use common\models\db\Products;
use frontend\controllers\MainWebController;
use frontend\modules\shop\models\CategoryShop;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `shop` module
 */
class DefaultController extends MainWebController
{
    function init()
    {
        parent::init();
    }


    public $layout = 'shop';

    /**
     * Renders the index view for the module
     * @return string
     * @throws \yii\base\InvalidArgumentException
     */
    public function actionIndex()
    {
        $categoryModel = new CategoryShop();
        $category = CategoryShop::find()->where([
            'type' => CategoryShop::TYPE_PRODUCT,
            'status' => \common\models\db\CategoryShop::STATUS_PUBLIC])->all();


        $categoryTreeArr = $categoryModel->getArrayTreeCategory($category);
        /*Debug::dd($categoryModel->outTree(0, 0));
        Debug::dd($categoryModel->getAllCategory($category, 0));
        $categoryTree = $categoryModel->getTreeCategory($categoryTreeArr, 0, []);*/

        //Получаем хит продаж
        $hitProducts = ProductMark::getProductsByMarks([ProductMark::MARK_HIT]);

        //Получаем товары для блока "Вам понравится"
        $jsonCatsKeys = KeyValue::findOne(['key' => 'you_like']);
        $catsKeys = json_decode($jsonCatsKeys->value);
        $categories = CategoryShop::findAll([
            'id' => $catsKeys,
            'type' => CategoryShop::TYPE_PRODUCT,
            'status' => \common\models\db\CategoryShop::STATUS_PUBLIC]);
        $products = Products::find()->where(['category_id' => $catsKeys, 'type' => Products::TYPE_PRODUCT])->limit(15)->all();

        //Получаем данные по баннеру
        $banner_photo = KeyValue::getValue('banner_path');
        $banner_url = KeyValue::getValue('banner_url');
        
        //получаем meta title и meta description
        $meta_title = KeyValue::getValue('shop_page_meta_title');
        $meta_descr = KeyValue::getValue('shop_page_meta_descr');
        
        return $this->render('index',
            [
                'hitProducts' => $hitProducts,
                'products' => $products,
                'categoryTree' => $categoryTreeArr,
                'like_categories' => $categories,
                'banner_photo' => $banner_photo,
                'banner_url' => $banner_url,
                'meta_title' => $meta_title,
                'meta_descr' => $meta_descr,
            ]
        );
    }


}
