<?php

namespace frontend\modules\exchange\controllers;

use common\classes\Debug;
use frontend\modules\exchange\models\Exchange;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `exchange` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $exchange = Exchange::getActiveCurrency();
        $model = new Exchange();
        $head = $model->attributeLabels();
        $usd = Exchange::getCurrencyValue('USD');
        $eur = Exchange::getCurrencyValue('EUR');

        return $this->render('index', [
            'exchange' => $exchange,
            'head' => $head,
            'usd' => $usd,
            'eur' => $eur,
        ]);
    }
}
