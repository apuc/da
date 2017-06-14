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
        $request = \Yii::$app->request->post('request');


        $search = new Search();
        $search->request = $request;
        $resultsCount = $search->getCountResults();


        Debug::prn($resultsCount);

        return $this->render('index',
            [
                'request' => $request,
                'resultsCount' => $resultsCount,
            ]
        );

    }

}