<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 03.10.2017
 * Time: 13:17
 */

namespace frontend\modules\search\controllers;

use common\classes\Debug;
use yii\web\Controller;

class TagController extends Controller
{
    public function actionIndex()
    {
        Debug::prn(\Yii::$app->request->get());

    }
}