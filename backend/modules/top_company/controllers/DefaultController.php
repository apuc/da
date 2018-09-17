<?php

namespace backend\modules\top_company\controllers;

use yii\web\Controller;

/**
 * Default controller for the `top_company` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
