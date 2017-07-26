<?php

namespace backend\modules\geobase_ip\controllers;

use yii\web\Controller;

/**
 * Default controller for the `geobase_ip` module
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
