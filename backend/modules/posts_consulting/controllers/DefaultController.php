<?php

namespace backend\modules\posts_consulting\controllers;

use yii\web\Controller;

/**
 * Default controller for the `Category_posts_consulting` module
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
