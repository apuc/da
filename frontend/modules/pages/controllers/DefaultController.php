<?php

namespace frontend\modules\pages\controllers;

use common\classes\Debug;
use common\classes\UserFunction;
use common\models\db\Pages;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
        if (empty($model)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $useReg = UserFunction::getRegionUser();
        return $this->render('view', ['model'=>$model , 'useReg' => $useReg]);
    }
}
