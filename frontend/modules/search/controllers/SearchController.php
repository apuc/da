<?php
/**
 * Created by PhpStorm.
 * User: warya
 * Date: 17.05.2017
 * Time: 15:23
 */

namespace frontend\modules\search\controllers;

use common\classes\Debug;
use frontend\modules\search\models\Search;
use yii\web\Controller;

class SearchController extends Controller
{
    function init()
    {
        parent::init();
    }


    public function actionIndex()
    {
        $request = \Yii::$app->request->get();


        $searchModel = new Search();

        $searchModel->request = trim($request['request']);
        $interval = (isset($request['interval'])) ? $request['interval'] : 'year';
        $searchModel->interval = $interval;
        $searchModel->type = (isset($request['type'])) ? $request['type'] : '';

        $dataProvider = $searchModel->search();

        $countMaterials = $searchModel->getCountMaterials();

        $allCount = $searchModel->allCountSearch($countMaterials);

        return $this->render('index',
            [
                'request' => $request,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'interval' => $interval,
                'countMaterials' => $countMaterials,
                'allCount' => $allCount,
            ]
        );

    }

}