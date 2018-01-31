<?php

namespace frontend\modules\shop\controllers;

use common\classes\Debug;
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
        return $this->render('index',
            [
                'categoryTree' => $categoryTreeArr,
            ]
        );
    }
}
