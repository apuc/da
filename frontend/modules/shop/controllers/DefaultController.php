<?php

namespace frontend\modules\shop\controllers;

use common\classes\Debug;
use common\models\db\KeyValue;
use common\models\db\Products;
use frontend\modules\shop\models\CategoryShop;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `shop` module
 */
class DefaultController extends Controller
{

    public $layout = 'shop';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $categoryModel = new CategoryShop();
        $category = CategoryShop::find()->all();


        $categoryTreeArr = $categoryModel->getArrayTreeCategory($category);
        /*Debug::dd($categoryModel->outTree(0, 0));
        Debug::dd($categoryModel->getAllCategory($category, 0));
        $categoryTree = $categoryModel->getTreeCategory($categoryTreeArr, 0, []);*/


        $jsonCatsKeys = KeyValue::findOne(['key' => 'you_like']);
        $catsKeys = json_decode($jsonCatsKeys->value);
        $categories = CategoryShop::findAll(['id' => $catsKeys]);
        $products = Products::find()->where(['category_id' => $catsKeys])->limit(15)->all();
        $banner_photo = KeyValue::getValue('banner_path');
        $banner_url = KeyValue::getValue('banner_url');
        return $this->render('index',
            [
                'products' => $products,
                'categoryTree' => $categoryTreeArr,
                'like_categories' => $categories,
                'banner_photo' => $banner_photo,
                'banner_url' => $banner_url,
            ]
        );
    }


}
