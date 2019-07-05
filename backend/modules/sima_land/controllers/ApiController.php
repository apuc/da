<?php

namespace backend\modules\sima_land\controllers;

use backend\modules\sima_land\components\SimaLand;
use backend\modules\sima_land\models\Sima_landSearch;
use common\classes\Debug;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;

class ApiController extends \yii\web\Controller
{
    public function actionSettings()
    {

    }

    public function actionProducts()
    {
        $searchModel = new Sima_landSearch();
        $dataProvider = $searchModel->search();

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }
}