<?php

namespace backend\modules\banned_ip\controllers;

use backend\modules\banned_ip\models\BannedIp;
use backend\modules\banned_ip\models\BannedIpSearch;
use Yii;


class BannedIpController extends \yii\web\Controller
{
    function init()
    {
        parent::init();
    }

    public function actionIndex()
    {
        $searchModel = new BannedIpSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}