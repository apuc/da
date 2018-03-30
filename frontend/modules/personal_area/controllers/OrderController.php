<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 30.03.18
 * Time: 10:45
 */

namespace frontend\modules\personal_area\controllers;

use common\classes\Debug;
use yii\web\Controller;

class OrderController extends Controller
{
    public $layout = 'personal_area';

    public function actionIndex()
    {
        return $this->render('index');
    }
}