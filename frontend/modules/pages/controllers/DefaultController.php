<?php

namespace frontend\modules\pages\controllers;

use common\classes\Debug;
use common\models\db\Pages;
use yii\web\Controller;

/**
 * Default controller for the `pages` module
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

    public function actionView($slug)
    {
        $model = Pages::findOne(['slug'=>$slug]);
        return $this->render('view', ['model'=>$model]);
    }
}
