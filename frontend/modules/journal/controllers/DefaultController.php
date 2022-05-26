<?php

namespace frontend\modules\journal\controllers;

use frontend\controllers\MainWebController;
use yii\web\Controller;

/**
 * Default controller for the `journal` module
 */
class DefaultController extends MainWebController
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
