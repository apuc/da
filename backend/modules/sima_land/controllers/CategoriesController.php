<?php


namespace backend\modules\sima_land\controllers;


use yii\web\Controller;

class CategoriesController extends Controller
{
    /**
     * Lists all categories models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
