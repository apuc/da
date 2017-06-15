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

    public function actionIndex()
    {
        $request = \Yii::$app->request->get('request');


        $searchModel = new Search();
        $searchModel->request = $request;
        $dataProvider = $searchModel->search();


       /* $search = new Search();*/

        $resultsCount = $searchModel->getCountResults();


        //Debug::prn($dataProvider);

        return $this->render('index',
            [
                'request' => $request,
                'resultsCount' => $resultsCount,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );

    }

}