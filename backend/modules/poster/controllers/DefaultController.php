<?php

namespace backend\modules\poster\controllers;

use yii\web\Controller;

/**
 * Default controller for the `poster` module
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
