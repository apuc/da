<?php

namespace backend\modules\sima_land\controllers;

use backend\modules\sima_land\components\SimaLand;
use backend\modules\sima_land\models\Sima_landSearch;
use backend\modules\sima_land\models\Sima_productSearch;
use common\classes\Debug;
use Yii;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;

class ApiController extends \yii\web\Controller
{
    public function actionSettings()
    {

    }

    public function actionCategories()
    {
        $searchModel = new Sima_landSearch();
        $dataProvider = $searchModel->search();

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

    public function actionProducts($page = 1)
    {
        $page = $page < 1 ? 1 : $page;
        $items = SimaLand::load('item', null, $page);
//        $searchModel = new Sima_productSearch();
//        $provider = $searchModel->search(Yii::$app->request->queryParams);
        $provider = new ArrayDataProvider([
            'allModels' => $items['items'],
        ]);

        return $this->render('products', compact('provider', 'searchModel', 'page'));
    }
}