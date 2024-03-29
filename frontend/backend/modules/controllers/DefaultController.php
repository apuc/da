<?php

namespace app\backend\modules\controllers;

use yii\web\Controller;

/**
 * Default controller for the `sima_land` module
 */
class DefaultController extends Controller
{
    function init()
    {
        parent::init();
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
