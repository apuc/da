<?php

namespace frontend\modules\metal_rates\controllers;

use common\classes\Debug;
use frontend\modules\metal_rates\models\MetalRates;
use yii\web\Controller;

/**
 * Default controller for the `metal_rates` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $date = date('Y-m-d', time());
        $metalRates = MetalRates::find()
            ->joinWith('metal')
            ->where(['date' => $date])
            ->all();
        return $this->render('index', compact('metalRates'));
    }
}
