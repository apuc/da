<?php

namespace backend\modules\pages_group\controllers;

use yii\web\Controller;

/**
 * Default controller for the `pages_group` module
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
