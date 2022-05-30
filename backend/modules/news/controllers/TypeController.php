<?php

namespace backend\modules\news\controllers;

use backend\modules\news\models\NewsTypeSearch;
use Yii;
use yii\web\Controller;

class TypeController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new NewsTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}