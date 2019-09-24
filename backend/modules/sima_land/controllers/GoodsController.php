<?php


namespace backend\modules\sima_land\controllers;


use yii\web\Controller;

class GoodsController extends Controller
{
    /**
     * Lists all goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
