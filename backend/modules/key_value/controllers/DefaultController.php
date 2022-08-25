<?php

namespace backend\modules\key_value\controllers;

use yii\web\Controller;

/**
 * Default controller for the `key_value` module
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
