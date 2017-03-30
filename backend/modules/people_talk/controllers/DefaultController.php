<?php

namespace backend\modules\people_talk\controllers;

use yii\web\Controller;

/**
 * Default controller for the `people_talk` module
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
